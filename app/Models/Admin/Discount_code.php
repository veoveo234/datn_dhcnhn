<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Discount_code extends Model
{
    protected $table = "discount_codes";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'category_id', 'affiliate_id', 'title', 'code', 'type_code', 'price', 'quantity', 'time', 'status'
    ];
    public $timestamps = true;
}
