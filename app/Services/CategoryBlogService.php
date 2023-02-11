<?php

namespace App\Services;

use App\Repositories\CategoryBlog\CategoryBlogRepository;
use Illuminate\Support\Facades\Storage;

class CategoryBlogService extends BaseServices
{
    protected $categoryBlogRepository;

    protected $urlImage = 'storage/images/cate_blogs/';

    public function __construct(
        CategoryBlogRepository $categoryBlogRepository
    ){
        $this->categoryBlogRepository = $categoryBlogRepository;
    }

    public function getListCateBlogs($params)
    {
        if ($params->status) {
            return $this->categoryBlogRepository->where('status', $params->status)->get()->toArray();
        }
        return $this->categoryBlogRepository->getAll()->toArray();
    }

    public function create($params)
    {
        if($params->hasFile('image')){
            $data['image'] = $params->file('image')->hashName();
            $data['name_cate'] = $params->name_cate;
            Storage::putFile('public/images/cate_blogs', $params->file('image'));
            return $this->categoryBlogRepository->save($data);
        }
        return false;
    }

    public function getById($id)
    {
        return $this->categoryBlogRepository->getById($id);
    }

    public function destroy($id)
    {
        $data = $this->categoryBlogRepository->getById($id, 'image');
        if($data) {
            deleteImage($this->urlImage . $data['image']);
            return $this->categoryBlogRepository->destroy($id);
        }
        return false;
    }

    public function update($id, $params)
    {
        $data_cate = $this->categoryBlogRepository->getById($id, 'image');
        $data['name_cate'] = $params->name_cate;
        $data['status'] = $params->status;
        if($params->hasFile('image')){
            $data['image'] = $params->file('image')->hashName();
            Storage::putFile('public/images/cate_blogs', $params->file('image'));
            deleteImage($this->urlImage . $data_cate['image']);
        }
        return $this->categoryBlogRepository->update($id, $data);
    }
}
