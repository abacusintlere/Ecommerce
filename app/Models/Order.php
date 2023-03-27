<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItems()
    {
        $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function shipping()
    {
        $this->hasOne(Shipping::class, 'shipping_id', 'id');
    }

    public function transaction()
    {
        $this->hasOne(Transaction::class, 'transaction_id', 'id');
    }
}
