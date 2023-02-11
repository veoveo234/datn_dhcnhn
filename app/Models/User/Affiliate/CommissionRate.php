<?php

namespace App\Models\User\Affiliate;

use Illuminate\Database\Eloquent\Model;

class CommissionRate extends Model
{
    protected $table = "commission_rates";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'category_id', 'rose_old', 'rose_new', 'status'
    ];
    public $timestamps = true;
}
