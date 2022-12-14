<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['category_name', 'description'];
    public function Img()
    {
        return $this->morphMany(Img::class, 'product_id', 'image_type');
    }
}
