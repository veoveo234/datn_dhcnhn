<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $primaryKey = "id";

    protected $fillable = [ 'id', 'gender_product', 'items', 'name_cate', 'status' ];
    
    public function productCategory(){
        return $this->hasMany('App\Models\Admin\Product\Product', 'id');
    }

    public $timestamps = true;
}
