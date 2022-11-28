<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Introduce extends Model
{
    use HasFactory;
    protected $table = 'introduces';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'index',
        'relate_id',
        'type',
        'link',
        'active',
        'subtitle'
    ];
    public function Img()
    {
        return $this->morphMany(Img::class, 'product_id', 'image_type');
    }
    public function Discount()
    {
        return $this->belongsTo(Discount::class, 'relate_id', 'id');
    }
}
