<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProcessingOrdersController extends Controller
{
    public function index(): View
    {
        $response = Http::get(env('API_BENEFICIARY_ENDPOINT') . 'orders/pending');

        $orders = $response->json()['data'];
        foreach ($orders as &$order) {
            $orders_receipts = DB::table('order_receipt')
                ->where('completed', true)
                ->where('order_id', $order['id'])
                ->get()
                ->toArray();
            if (count($orders_receipts) <= 0) {
                unset($order);
            } else {
                $receipt = Receipt::find($orders_receipts[0]->receipt_id);
                $order['receipt'] = $receipt;
            }
        }
        $orders = array_values($orders);

        return view('orders.processing.index', compact('orders'));
    }

    public function complete($order_id): RedirectResponse
    {
        $response = Http::patch(env('API_BENEFICIARY_ENDPOINT') . 'orders/update/state', [
            'order_id' => $order_id,
            'state_id' => 3, // Completed
        ]);

        if ($response->ok()) {
            return redirect(route('processing_orders.index'))->with('success', __('Order completed'));
        }

        return redirect(route('processing_orders.index'))->with('error', __('Error trying to complete the order, try again later'));
    }
}
