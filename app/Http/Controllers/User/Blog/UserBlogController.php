<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class UserBlogController extends Controller
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
        $cateBlog = $this->blogService->getListCateBlogs();
        $blogs = $this->blogService->getBlogAll();
        return view('User.pages.blog.index')->with(
            [
                'cateBlog' => $cateBlog->take(3),
                'blogs' => $blogs
            ]
        );
    }

    public function show($id)
    {
        try {
            $blog = $this->blogService->getById($id);
            $update_view = $this->blogService->updateView($id);
            if(!$blog) {
                abort(404);
            }
            return view('User.pages.blog.detail')->with(
                [
                    'blog' => $blog
                ]
            );

        } catch (\Exception $e) {
            logger($e->getMessage());
            abort(404);
            return false;
        }
    }
}
