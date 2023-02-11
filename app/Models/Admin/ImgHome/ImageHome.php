<?php

namespace App\Models\Admin\ImgHome;

use Illuminate\Database\Eloquent\Model;

class ImageHome extends Model
{
    protected $table = "image_home";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'img_banner', 'name_banner', 'title_banner', 'des_banner', 'img_bottom_banner_1', 'name_bottom_banner_1', 'title_bottom_banner_1', 'img_bottom_banner_2', 'name_bottom_banner_2', 'title_bottom_banner_2', 'img_bottom_banner_3', 'name_bottom_banner_3', 'title_bottom_banner_3', 'img_footer_banner', 'name_footer_banner', 'title_footer_banner', 'des_footer_banner', 'status', 'created_at', 'updated_at'
    ];
    public $timestamps = true;
}
