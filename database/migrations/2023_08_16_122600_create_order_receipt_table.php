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
        Schema::create('order_receipt', function (Blueprint $table) {
            $table->integer('order_id');
            $table->integer('receipt_id');
            $table->boolean('completed');
            $table->timestamps();

            $table->primary(['order_id', 'receipt_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_receipt');
    }
};
