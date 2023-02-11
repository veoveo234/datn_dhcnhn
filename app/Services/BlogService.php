<?php

namespace App\Services;

use App\Repositories\Blog\BlogRepository;
use App\Repositories\CategoryBlog\CategoryBlogRepository;
use Illuminate\Support\Facades\Storage;

class BlogService extends BaseServices
{
    protected $blogRepository;

    protected $categoryBlogRepository;

    public function __construct(
        BlogRepository $blogRepository,
        CategoryBlogRepository $categoryBlogRepository
    ){
        $this->blogRepository = $blogRepository;
        $this->categoryBlogRepository = $categoryBlogRepository;
    }

    public function getListBlogs($params)
    {
        return $this->blogRepository->getAll()->toArray();
    }

    public function getListCateBlogs()
    {
        return $this->categoryBlogRepository->getAll();
    }

    public function create($params)
    {
        if($params->hasFile('image')){
            $data['main_image'] = $params->file('image')->hashName();
            $data['cate_id'] = $params->cate_id;
            $data['user_id'] = session('user_id');
            $data['title'] = $params->title;
            $data['description'] = $params->description;
            $data['content_blog'] = $params->content_blog;
            Storage::putFile('public/images/blogs', $params->file('image'));
            return $this->blogRepository->save($data);
        }
        return false;
    }
    public function updateView($id)
    {
        return $this->blogRepository->model()::where('id', $id)->increment('views', 1);
    }
    public function getBlogAll()
    {
        return $this->blogRepository->getWithPaginate();
    }

    public function getById($id)
    {
        return $this->blogRepository->getById($id);
    }

}
