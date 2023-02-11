<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";

    protected $primaryKey = "id";

    protected $fillable = ['id', 'name_brand', 'image_brand', 'views', 'status'];
    
    public $timestamps = true;
    
    public function productBrand(){
        return $this->hasMany('App\Models\Admin\Product\Product', 'id');
    }
}
