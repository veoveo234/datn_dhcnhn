@extends('index')
@section('cssPage')

@endsection

@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="blog">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Our Blog</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->


    <!--================Blog Categorie Area =================-->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">
                @foreach($cateBlog as $cate)
                    <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="categories_post">
                            <img class="card-img rounded-0" src="{{ asset('storage/images/cate_blogs/'. $cate->image) }}" alt="post">
                            <div class="categories_details">
                                <div class="categories_text">
                                    <a href="single-blog.html">
                                        <h5>{{ $cate->name_cate }}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================Blog Categorie Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_left_sidebar">
                        @foreach($blogs as $blog)
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#">{{ $blog->categoryBlog->name_cate }}</a>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li>
                                            <a href="#">{{ $blog->user->name }}
                                                <i class="lnr lnr-user"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">{{ $blog->created_at->format('Y-m-d') }}
                                                <i class="lnr lnr-calendar-full"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">{{ $blog->views }} Lượt xem
                                                <i class="lnr lnr-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">06 Bình luận
                                                <i class="lnr lnr-bubble"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ asset('storage/images/blogs/'. $blog->main_image) }}" alt="">
                                    <div class="blog_details">
                                        <a href="{{ route('blog.user.show', $blog->id) }}">
                                            <h2>{{ $blog->title }}</h2>
                                        </a>
                                        {{ $blog->description }}
                                        <a class="button button-blog" href="{{ route('blog.user.show', $blog->id) }}">View More</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                {{ $blogs->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('ajax')
@endsection
