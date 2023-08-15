<?php

namespace App\Console\Commands;

use App\Models\IngredientReceipt;
use App\Models\Receipt;
use Illuminate\Console\Command;

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

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 1; // Tomato
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 1;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 9; // Meat
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 2;
        $ingredientReceipt->save();
        
        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 7; // Onion
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 3;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 5; // Ketchup
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 1;
        $ingredientReceipt->save();

        $receipt = new Receipt();
        $receipt->name = 'Beef stew with potatoes';
        $receipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 9; // Meat
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 2;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 3; // Potato
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 3;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 7; // Onion
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 1;
        $ingredientReceipt->save();

        $receipt = new Receipt();
        $receipt->name = 'tomato and Lettuce salad';
        $receipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 1; // Tomato
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 2;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 6; // Lettuce
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 3;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 2; // Lemon
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 1;
        $ingredientReceipt->save();

        $receipt = new Receipt();
        $receipt->name = 'Rice with chicken and mild cheese sauce';
        $receipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 4; // Rice
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 2;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 10; // Chicken
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 3;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 8; // Cheese
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 1;
        $ingredientReceipt->save();

        $receipt = new Receipt();
        $receipt->name = 'Mexican style rice with chicken';
        $receipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 10; // Chicken
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 2;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 8; // Cheese
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 3;
        $ingredientReceipt->save();

        $receipt = new Receipt();
        $receipt->name = 'Green rice roll with chicken and cheese';
        $receipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 4; // Rice
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 1;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 10; // Chicken
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 2;
        $ingredientReceipt->save();

        $ingredientReceipt = new IngredientReceipt();
        $ingredientReceipt->ingredient_id = 8; // Cheese
        $ingredientReceipt->receipt_id = $receipt->id;
        $ingredientReceipt->quantity = 3;
        $ingredientReceipt->save();

        $this->info('The command was successful!');
    }
}
