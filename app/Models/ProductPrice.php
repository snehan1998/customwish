<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'variation_id', 'price','strick_price','discount',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
