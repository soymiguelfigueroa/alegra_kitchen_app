<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $response = Http::get(env('API_BENEFICIARY_ENDPOINT') . 'orders/created');

        $orders = $response->json()['data'];

        return view('order.index', compact('orders'));
    }

    public function prepare($id)
    {
        $response = Http::patch(env('API_BENEFICIARY_ENDPOINT') . 'orders/update/state', [
            'order_id' => $id,
            'state_id' => 2,
        ]);

        if ($response->ok()) {
            return redirect(route('order.index'))->with('success', 'Order updated');
        }

        return redirect(route('order.index'))->with('error', 'Error updating order');
    }
}
