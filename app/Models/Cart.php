<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = ['user', 'product'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'user',
        'product',
        'quantity',
        'price',
        'product_name',
    ];
}
