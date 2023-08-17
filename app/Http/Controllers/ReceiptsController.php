<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ReceiptsController extends Controller
{
    public function index(): View
    {
        $receipts = Receipt::all();

        return view('receipts.index', compact('receipts'));
    }

    public function show(Receipt $receipt)
    {
        $ingredients_receipt = DB::table('ingredient_receipt')
            ->where('receipt_id', $receipt->id)
            ->get()
            ->toArray();
        $response = Http::get(env('API_WAREHOUSE_ENDPOINT') . 'ingredients/get_by_receipt', [
            'ingredients_receipt' => $ingredients_receipt
        ]);
        $ingredients = $response->json();

        return view('receipts.show', compact('receipt', 'ingredients'));
    }
}