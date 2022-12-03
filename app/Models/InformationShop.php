<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationShop extends Model
{
    use HasFactory;
    protected $table = 'information_shop';
    protected $fillable = [
        'message',
        'address',
        'coordinates',
        'nation',
    ];
    protected $casts = [
        'created_at' => 'date:d/m/Y',
        'updated_at' => 'date:d/m/Y',
    ];
    public function Img()
    {
        return $this->morphMany(Img::class, 'product_id', 'image_type');
    }
}
