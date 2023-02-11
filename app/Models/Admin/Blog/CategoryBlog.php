<?php

namespace App\Models\Admin\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryBlog extends Model
{
    protected $table = 'category_blogs';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'name_cate', 'status', 'image'];

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'cate_blog_id', 'id');
    }
}
