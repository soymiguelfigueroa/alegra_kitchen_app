<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingredient_receipt', function (Blueprint $table) {
            $table->integer('ingredient_id');
            $table->integer('receipt_id');
            $table->integer('quantity');
            $table->primary(['ingredient_id', 'receipt_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_receipt');
    }
};
