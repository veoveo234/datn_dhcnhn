<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class DetailSize extends Model
{
    protected $table = "detail_sizes";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'product_id', 'name_size', 'quantity', 'status'
    ];
    public $timestamps = true;

    public function productSize(){
        return $this->belongsTo('App\Models\Admin\Product\Product', 'product_id', 'id');
    }
}
