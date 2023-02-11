<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'product_id', 'member_id', 'email', 'name', 'comment', 'status'
    ];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Product\Product', 'product_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\User\Member\Member', 'member_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Admin\Product\ReplyComment', 'comment_id', 'id');
    }
}
