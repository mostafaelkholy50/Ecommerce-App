<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
  protected  $fillable = [
        'user_id',
        'product_id',
        'content',
        'rating',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    /**
     * Get the product that owns the comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(products::class,'product_id');
    }
}
