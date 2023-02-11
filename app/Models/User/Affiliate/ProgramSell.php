<?php

namespace App\Models\User\Affiliate;

use Illuminate\Database\Eloquent\Model;

class ProgramSell extends Model
{
    protected $table = "program_sells";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'commission_id', 'product_id', 'image', 'title', 'rose_old', 'rose_new', 'description', 'status'
    ];
    public $timestamps = true;
}
