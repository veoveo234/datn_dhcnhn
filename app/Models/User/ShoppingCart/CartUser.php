<?php

namespace App\Models\User\ShoppingCart;

use Illuminate\Database\Eloquent\Model;

class CartUser extends Model
{
    protected $table = "cart_users";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'member_id', 'product_id', 'name', 'quantity', 'price', 'sale', 'name_size', 'image', 'status'
    ];
    public $timestamps = true;

}
