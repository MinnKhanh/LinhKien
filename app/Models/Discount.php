<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discount';
    protected $fillable = [
        'type',
        'percent',
        'code',
        'begin',
        'end',
        'unit',
        'name',
        'description',
        'relation_id'
    ];
    public $timestamps = false;
    public function Img()
    {
        return $this->morphMany(Img::class, 'product_id', 'image_type');
    }
}
