<?php

namespace App\Repositories\CategoryBlog;

use App\Models\Admin\Blog\CategoryBlog;
use App\Repositories\BaseRepository;

class CategoryBlogRepository extends BaseRepository
{
    public function model(): string
    {
        return CategoryBlog::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function destroy($id): bool
    {
        $category = $this->model->find($id);
        if ($category) {
            $category->destroy($id);
            return true;
        }
        return false;
    }

    public function save($params)
    {
        $data = new $this->model();

        $data->name_cate = $params['name_cate'];
        $data->image = $params['image'];
        $data->created_at = now();
        $data->timestamps = false;
        $data->save();

        return $data;
    }
}
