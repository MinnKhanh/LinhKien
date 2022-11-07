<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'user',
        'address',
        'city',
        'district',
        'note',
        'phone',
        'email',
        'discount',
        'ship',
        'type',
        'totalPrice',
        'quantity',
        'status',
    ];
    protected $casts = [
        'created_at' => 'date:d/m/Y',
        'updated_at' => 'date:d/m/Y',
    ];
    public function UserOrder()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
