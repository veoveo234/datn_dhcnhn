<?php

namespace App\Models\User\Affiliate;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    protected $table = "referals";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'partner_id', 'program_id', 'link_code', 'rose_old', 'status'
    ];
    public $timestamps = true;
}
