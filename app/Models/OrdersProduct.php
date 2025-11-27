<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    use HasFactory;

    protected $table = 'orders_products'; 

    // Mối quan hệ tới bảng products
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Mối quan hệ tới bảng orders (nếu có)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
