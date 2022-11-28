<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_discount',
        'condition',
    ];
    protected $table = 'discount_detail';
}
