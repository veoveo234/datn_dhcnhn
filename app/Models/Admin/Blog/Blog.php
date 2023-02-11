<?php

namespace App\Models\Admin\Blog;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'cate_id',
        'user_id',
        'title',
        'main_image',
        'description',
        'content_blog',
        'views',
        'status'
    ];

    public function categoryBlog(): BelongsTo
    {
        return $this->belongsTo(CategoryBlog::class, 'cate_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
