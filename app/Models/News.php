<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'user',
        'title',
        'content',
        'description',
    ];
    protected $casts = [
        'created_at' => 'date:d/m/Y',
        'updated_at' => 'date:d/m/Y',
    ];
    public function Img()
    {
        return $this->morphMany(Img::class, 'product_id', 'image_type');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
