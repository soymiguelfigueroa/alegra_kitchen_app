<?php

namespace App\Console\Commands;

use App\Models\IngredientReceipt;
use App\Models\Receipt;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $receipt = new Receipt();
        $receipt->name = 'Meat with Tomato';
        $receipt->save();
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 1, // Tomato
            'receipt_id' => $receipt->id,
            'quantity' => 1,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 9, // Meat
            'receipt_id' => $receipt->id,
            'quantity' => 2,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 7, // Onion
            'receipt_id' => $receipt->id,
            'quantity' => 3,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 5, // Ketchup
            'receipt_id' => $receipt->id,
            'quantity' => 1,
        ]);

        $receipt = new Receipt();
        $receipt->name = 'Beef stew with potatoes';
        $receipt->save();
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 9, // Meat
            'receipt_id' => $receipt->id,
            'quantity' => 2,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 3, // Potato
            'receipt_id' => $receipt->id,
            'quantity' => 3,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 7, // Onion
            'receipt_id' => $receipt->id,
            'quantity' => 1,
        ]);

        $receipt = new Receipt();
        $receipt->name = 'tomato and Lettuce salad';
        $receipt->save();
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 1, // Tomato
            'receipt_id' => $receipt->id,
            'quantity' => 2,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 6, // Lettuce
            'receipt_id' => $receipt->id,
            'quantity' => 3,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 2, // Lemon
            'receipt_id' => $receipt->id,
            'quantity' => 1,
        ]);

        $receipt = new Receipt();
        $receipt->name = 'Rice with chicken and mild cheese sauce';
        $receipt->save();
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 4, // Rice
            'receipt_id' => $receipt->id,
            'quantity' => 2,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 10, // Chicken
            'receipt_id' => $receipt->id,
            'quantity' => 3,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 8, // Cheese
            'receipt_id' => $receipt->id,
            'quantity' => 1,
        ]);

        $receipt = new Receipt();
        $receipt->name = 'Mexican style rice with chicken';
        $receipt->save();
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 10, // Chicken
            'receipt_id' => $receipt->id,
            'quantity' => 2,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 8, // Cheese
            'receipt_id' => $receipt->id,
            'quantity' => 3,
        ]);

        $receipt = new Receipt();
        $receipt->name = 'Green rice roll with chicken and cheese';
        $receipt->save();
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 4, // Rice
            'receipt_id' => $receipt->id,
            'quantity' => 1,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 10, // Chicken
            'receipt_id' => $receipt->id,
            'quantity' => 2,
        ]);
        DB::table('ingredient_receipt')->insert([
            'ingredient_id' => 8, // Cheese
            'receipt_id' => $receipt->id,
            'quantity' => 3,
        ]);

        $this->info('The command was successful!');
    }
}
