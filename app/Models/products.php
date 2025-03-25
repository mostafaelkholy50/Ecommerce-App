<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    protected $fillable = ['name','description','price','stock','image','category_id'];
    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function comment(){
        return $this->hasMany(comment::class);
    }
}
