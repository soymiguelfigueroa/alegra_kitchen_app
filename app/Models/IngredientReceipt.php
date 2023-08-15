<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientReceipt extends Model
{
    use HasFactory;

    public $table = 'ingredient_receipt';

    protected $primaryKey = [
        'ingredient_id',
        'receipt_id',
    ];

    public $fillable = [
        'quantity',
    ];
}
