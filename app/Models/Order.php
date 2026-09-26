<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'first_name', 'last_name', 'address', 'city', 'message', 'total_price', 'status'];

    // Narudžbina pripada jednom korisniku
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Narudžbina ima više stavki
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
