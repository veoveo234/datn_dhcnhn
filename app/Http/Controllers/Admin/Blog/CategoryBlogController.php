<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCateBlogsRequest;
use App\Http\Requests\Admin\UpdateCateBlogsRequest;
use App\Services\CategoryBlogService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CategoryBlogController extends Controller
{
    protected $categoryBlogService;

    public function __construct(
        CategoryBlogService $categoryBlogService
    )
    {
        $this->categoryBlogService = $categoryBlogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application
     */
    public function index(Request $request)
    {
        if(request()->ajax()) {
            $data = $this->categoryBlogService->getListCateBlogs($request);
            return $this->datatables($data);
        }
        return view('admin.pages.category-blog.index');
    }

    public function datatables($data)
    {
        return Datatables::of($data)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCateBlogsRequest $request
     * @return JsonResponse
     */
    public function store(StoreCateBlogsRequest $request): JsonResponse
    {
        try {
            $data = $this->categoryBlogService->create($request);
            if($data) {
                return $this->response(HTTP_SUCCESS, trans('messages.blog.category.create_success'));
            }
            return $this->response(HTTP_STATUS_PAGE['SERVER_ERROR'], trans('messages.blog.category.create_failed'));

        } catch (\Exception $e) {
            logger($e->getMessage());
            return $this->response(HTTP_STATUS_PAGE['SERVER_ERROR'], trans('messages.blog.category.create_failed'));
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
