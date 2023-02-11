<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateCateBlogsRequest;
use App\Services\BlogService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(
        BlogService $blogService
    )
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application
     */
    public function index(Request $request)
    {
        if(request()->ajax()) {
            $data = $this->blogService->getListBlogs($request);
            return $this->datatables($data);
        }
        $cateBlog = $this->blogService->getListCateBlogs();
        return view('admin.pages.blog.index')->with(
            [
                'cateBlog' =>  $cateBlog
            ]
        );
    }

    public function datatables($data)
    {
        return Datatables::of($data)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBlogRequest $request
     * @return JsonResponse
     */
    public function store(StoreBlogRequest $request): JsonResponse
    {
        try {
            $data = $this->blogService->create($request);
            if($data) {
                return $this->response(HTTP_SUCCESS, trans('messages.blog.blogs.create_success'));
            }
            return $this->response(HTTP_STATUS_PAGE['SERVER_ERROR'], trans('messages.blog.blogs.create_failed'));

        } catch (\Exception $e) {
            logger($e->getMessage());
            return $this->response(HTTP_STATUS_PAGE['SERVER_ERROR'], trans('messages.blog.blogs.create_failed'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $cateBlogs = $this->categoryBlogService->getById($id);
        $code = HTTP_SUCCESS;
        if (!$cateBlogs) {
            $code = HTTP_STATUS_PAGE['NOT_FOUND'];
        }
        $view = view('admin.pages.category-blog.show', compact('cateBlogs'))->render();
        return $this->response($code, null, $view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCateBlogsRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCateBlogsRequest $request, int $id): JsonResponse
    {
        try {
            $this->categoryBlogService->update($id, $request);
            return $this->response(HTTP_SUCCESS, trans('messages.blog.category.update_success'));
        } catch (\Exception $e) {
            logger($e->getMessage());
            return $this->response(HTTP_STATUS_PAGE['SERVER_ERROR'], trans('messages.blog.category.update_failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->categoryBlogService->destroy($id);
            return $this->response(HTTP_SUCCESS, trans('messages.blog.category.delete_success'));
        } catch (\Exception $e) {
            logger($e->getMessage());
            return $this->response(HTTP_STATUS_PAGE['SERVER_ERROR'], trans('messages.blog.category.delete_failed'));
        }
    }
}
