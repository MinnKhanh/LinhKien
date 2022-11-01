<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorite';
    protected $primaryKey = ['user', 'product'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'user',
        'product',
    ];
}
