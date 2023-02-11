<?php

namespace App\Models\User\Member;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "members";

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'avatar', 'name', 'phone', 'address', 'email', 'password', 'point', 'status'
    ];
    public $timestamps = true;

    public function comments()
    {
        return $this->hasMany(App\Models\Admin\Product\Comment::class);
    }
}
