<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getOrdersData($response)
    {
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
        return array_values($orders);
    }
}
