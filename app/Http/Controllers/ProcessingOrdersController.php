<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProcessingOrdersController extends Controller
{
    public function index(): View
    {
        $response = Http::get(env('API_BENEFICIARY_ENDPOINT') . 'orders/pending');

        $orders = $this->getOrdersData($response, false);

        return view('orders.processing.index', compact('orders'));
    }

    public function complete($order_id): RedirectResponse
    {
        $response = Http::patch(env('API_BENEFICIARY_ENDPOINT') . 'orders/update/state', [
            'order_id' => $order_id,
            'state_id' => 3, // Completed
        ]);

        $order_receipt = DB::table('order_receipt')
            ->where('order_id', $order_id)
            ->update([
                'completed' => true,
            ]);

        if ($response->ok()) {
            return redirect(route('processing_orders.index'))->with('success', __('Order completed'));
        }

        return redirect(route('processing_orders.index'))->with('error', __('Error trying to complete the order, try again later'));
    }
}
