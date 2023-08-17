<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 * @property mixed $id
 */
class Receipt extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
    ];
}
