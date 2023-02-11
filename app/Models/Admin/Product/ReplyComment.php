<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    protected $table = "reply_comments";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'comment_id', 'member_id', 'reply_comment', 'status'
    ];
    public $timestamps = true;

    public function member(){
        return $this->belongsTo('App\Models\User\Member\Member', 'member_id', 'id');
    }
}
