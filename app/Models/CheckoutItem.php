<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutItem extends Model
{
    /** @use HasFactory<\Database\Factories\CheckoutItemFactory> */
    use HasFactory;
    protected $fillable = ['checkout_id', 'product_id', 'quantity', 'price'];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function getTotalPrice()
    {
        return $this->quantity * $this->product->price;
    }
}
