<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    /** @use HasFactory<\Database\Factories\CheckoutFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'Address', 'Phone', 'payment_method', 'payment_status', 'shipping_status', 'total_price'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkoutItems()
    {
        return $this->hasMany(CheckoutItem::class, 'checkout_id');
    }
    public function cart()
    {
        return $this->hasMany(cart::class);
    }
}
