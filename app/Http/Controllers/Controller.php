<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getOrdersData($response, $processed)
    {
        $orders = $response->json()['data'];
        foreach ($orders as $key => &$order) {
            // Get only order receipts not completed
            $orders_receipts = DB::table('order_receipt')
                ->where('completed', $processed)
                ->where('order_id', $order['id'])
                ->get()
                ->toArray();
            if (count($orders_receipts) <= 0) {
                unset($orders[$key]);
            } else {
                $receipt = Receipt::find($orders_receipts[0]->receipt_id);
                $order['receipt'] = $receipt;
                $ingredients_order = DB::table('ingredient_order')
                    ->where('order_id', $order['id'])
                    ->get()
                    ->toArray();
                $ingredients_delivered = true;
                foreach($ingredients_order as $value) {
                    if (!$value->delivered) {
                        $ingredients_delivered = false;
                        break;
                    }
                }
                $response = Http::get(env('API_WAREHOUSE_ENDPOINT') . 'ingredients/get_by_order', [
                    'ingredients_order' => $ingredients_order
                ]);
                $order['ingredients_delivered'] = $ingredients_delivered;
                $order['ingredients'] = $response->json();
            }
        }
        return array_values($orders);
    }
}
