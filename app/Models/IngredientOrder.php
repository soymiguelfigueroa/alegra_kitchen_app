<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientOrder extends Model
{
    use HasFactory;

    protected $primaryKey = [
        'ingredient_id',
        'order_id',
    ];

    public $fillable = [
        'quantity',
        'delivered',
    ];
}
