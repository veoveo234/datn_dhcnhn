<?php

namespace App\Models\User\ShoppingCart;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'order_id', 'member_id', 'total_money', 'note', 'vnp_response_code', 'code_vnpay', 'code_bank', 'card_type', 'status'
    ];
    public $timestamps = true;
}
