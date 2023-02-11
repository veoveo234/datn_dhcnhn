<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class DetailImage extends Model
{
    protected $table = "detail_images";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'product_id', 'sub_image', 'status'
    ];
    public $timestamps = true;
    
    public function productImage(){
        return $this->belongsTo('App\Models\Admin\Product\Product', 'product_id', 'id');
    }
}
