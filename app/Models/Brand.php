<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brand';
    protected $fillable = [
        'brand_name',
        'brand_nation',
        'brand_description',
        'brand_website'
    ];
    public function Img()
    {
        return $this->morphMany(Img::class, 'product_id', 'image_type');
    }
}
