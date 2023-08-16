<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CreatedOrdersController extends Controller
{
    public function index(): View
    {
        $response = Http::get(env('API_BENEFICIARY_ENDPOINT') . 'orders/created');

        $orders = $response->json()['data'];

        return view('orders.created.index', compact('orders'));
    }

    public function prepare($order_id): RedirectResponse
    {
        $order = $this->getOrder($order_id);
        $receipt = $this->selectReceiptRandomly();
        $this->registerReceiptOrder($receipt, $order);
        $receipt_ingredients = $this->getReceiptIngredients($receipt);
        $this->registerIngredientByOrder($receipt_ingredients, $order);

        $response = Http::patch(env('API_BENEFICIARY_ENDPOINT') . 'orders/update/state', [
            'order_id' => $order['id'],
            'state_id' => 2,
        ]);

        if ($response->ok()) {
            return redirect(route('created.index'))->with('success', 'Order updated');
        }

        return redirect(route('created.index'))->with('error', 'Error updating created');
    }

    public function getUndeliveredIngredients(): Collection
    {
        return DB::table('ingredient_order')->where('delivered', false)->orderBy('order_id')->get();
    }

    public function deliverIngredients(Request $request): Response
    {
        $ingredient_id = $request->ingredient_id;
        $order_id = $request->order_id;

        DB::table('ingredient_order')->where([
            'ingredient_id' => $ingredient_id,
            'order_id' => $order_id,
        ])->update([
            'delivered' => true,
        ]);

        $this->verifyOrderAndUpdateIfAllIngredientsAreDelivered($order_id, $ingredient_id);

        return response('Ingredient delivered', 200);
    }

    private function getOrder($order_id)
    {
        $response = Http::get(env('API_BENEFICIARY_ENDPOINT') . 'orders', [
            'id' => $order_id
        ]   );
        return $response->json()['data'][0];
    }

    private function selectReceiptRandomly()
    {
        $receipt_ids = DB::table('receipts')->select('id')->get()->toArray();

        return Receipt::find(Arr::random($receipt_ids)->id);
    }

    private function getReceiptIngredients($receipt): Collection
    {
        return DB::table('ingredient_receipt')->where('receipt_id', $receipt->id)->get();
    }

    private function registerIngredientByOrder(Collection $receipt_ingredients, mixed $order): void
    {
        foreach ($receipt_ingredients as $ingredient) {
            DB::table('ingredient_order')->insert([
                'ingredient_id' => $ingredient->ingredient_id,
                'order_id' => $order['id'],
                'quantity' => ($ingredient->quantity * $order['quantity']),
                'delivered' => false,
            ]);
        }
    }

    private function registerReceiptOrder($receipt, $order): void
    {
        DB::table('order_receipt')->insert([
            'order_id' => $order['id'],
            'receipt_id' => $receipt->id,
            'completed' => false,
        ]);
    }

    private function verifyOrderAndUpdateIfAllIngredientsAreDelivered($order_id, $ingredient_id): void
    {
        $ingredients_orders = DB::table('ingredient_order')
            ->where('order_id', $order_id)
            ->whereNot('ingredient_id', $ingredient_id)
            ->get();

        $all_ingredients_are_delivered = true;

        foreach ($ingredients_orders as $ingredient) {
            if (!$ingredient->delivered) {
                $all_ingredients_are_delivered = false;
                break;
            }
        }

        if ($all_ingredients_are_delivered) {
            DB::table('order_receipt')->where('order_id', $order_id)->update([
                'completed' => true,
            ]);
        }
    }
}
