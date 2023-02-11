<?php

namespace App\Models\User\ShoppingCart;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'member_id', 'note', 'total_money', 'ship_method', 'payment_method', 'status'
    ];
    public $timestamps = true;
}
