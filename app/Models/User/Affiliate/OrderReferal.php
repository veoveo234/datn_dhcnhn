<?php

namespace App\Models\User\Affiliate;

use Illuminate\Database\Eloquent\Model;

class OrderReferal extends Model
{
    protected $table = "order_referals";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'order_id', 'product_id', 'referal_id', 'rose', 'total_rose', 'status'
    ];
    public $timestamps = true;
}
