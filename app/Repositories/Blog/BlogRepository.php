<?php

namespace App\Repositories\Blog;

use App\Models\Admin\Blog\Blog;
use App\Repositories\BaseRepository;
use App\Traits\HandleImage;

class BlogRepository extends BaseRepository
{
    use HandleImage;
    protected $path = "admin-assets/uploads/blog/";

    public function model()
    {
        return Blog::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function getWithPaginate($quantity = 1)
    {
        return $this->model->latest('id')->paginate($quantity);
    }

    public function save($params)
    {
        $data = new $this->model();

        $data->cate_id = $params['cate_id'];
        $data->user_id = $params['user_id'];
        $data->title = $params['title'];
        $data->main_image = $params['main_image'];
        $data->description = $params['description'];
        $data->content_blog = $params['content_blog'];
        $data->views = 0;
        $data->created_at = now();
        $data->timestamps = false;
        $data->save();

        return $data;
    }

    public function update($id, $attributes)
    {

    }

    public function destroy($id): bool
    {
        $blog = $this->model->find($id);
        if ($blog) {
            $blog->destroy($id);
            $this->deleteImage($blog->main_image, $this->path);
            return true;
        }
        return false;
    }

    public function search($request)
    {
        return $this->model->latest('id')->paginate(5);
    }
}
