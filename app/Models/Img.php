<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    use HasFactory;
    protected $table = 'image';
    protected $fillable = [
        'image_name',
        'product_id',
        'image_type',
    ];
    public function ImgProduct()
    {
        return $this->morphTo();
    }
}
