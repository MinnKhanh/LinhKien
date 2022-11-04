<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendor';
    protected $fillable = [
        'vendor_name',
        'vendor_address',
        'vendor_phone',
        'vendor_website',
    ];
    public function Img()
    {
        return $this->morphMany(Img::class, 'product_id', 'image_type');
    }
}
