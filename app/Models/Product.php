<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'product_name',
        'import_price',
        'price',
        'amount',
        'status',
        'description',
        'brand',
        'vendor',
        'trend',
        'code'
    ];
    public function Img()
    {
        return $this->morphMany(Img::class, 'product_id', 'image_type');
    }
    public function Discount()
    {
        return $this->hasMany(Discount::class, 'relation_id', 'id');
    }
}
