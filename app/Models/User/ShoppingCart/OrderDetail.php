<?php

namespace App\Models\User\ShoppingCart;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";

    protected $fillable = [
        'order_id', 'product_id', 'name', 'name_size', 'quantity', 'price', 'total_money'
    ];
    public $timestamps = true;
}
