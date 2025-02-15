<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    public function products() 
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
    }

    public function updateTotalPrice()
    {
        $totalPrice = $this->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        $this->update(['total_price' => $totalPrice]);
    }
}
