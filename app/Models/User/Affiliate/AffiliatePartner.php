<?php

namespace App\Models\User\Affiliate;

use Illuminate\Database\Eloquent\Model;

class AffiliatePartner extends Model
{
    protected $table = "affiliate_partners";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'avatar', 'firstname', 'lastname', 'email', 'profession', 'address', 'phone', 'password', 'total_rose', 'status'
    ];
    public $timestamps = true;
}
