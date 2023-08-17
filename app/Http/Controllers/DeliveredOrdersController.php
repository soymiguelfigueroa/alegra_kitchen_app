<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class DeliveredOrdersController extends Controller
{
    public function index(): View
    {
        $response = Http::get(env('API_BENEFICIARY_ENDPOINT') . 'orders/delivered');

        $orders = $this->getOrdersData($response);

        return view('orders.delivered.index', compact('orders'));
    }
}
