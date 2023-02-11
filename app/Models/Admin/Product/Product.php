<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'category_id', 'brand_id', 'name', 'main_image', 'price', 'description', 'sale', 'views', 'status'
    ];
    public $timestamps = true;

    public function categories(){
        return $this->belongsTo('App\Models\Admin\Product\Category', 'category_id', 'id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Admin\Product\Brand', 'brand_id', 'id');
    }

    public function detailSize(){
        return $this->hasMany('App\Models\Admin\Product\DetailSize', 'product_id', 'id');
    }

    public function detailImage(){
        return $this->hasMany('App\Models\Admin\Product\DetailImage', 'product_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Admin\Product\Comment', 'product_id', 'id')->orderBy('id', 'desc');
    }
}
