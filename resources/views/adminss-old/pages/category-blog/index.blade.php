@extends('admin-index')
@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12">
                <!-- Button -->
                <div class="d-flex">
                    <button class="btn btn-primary btn-round mb-3" id="new-cate-blog" data-toggle="modal"
                            data-target="#modal-add-cate-blog">
                        <i class="fa fa-plus"></i> Thêm mới danh muc blog
                    </button>
                </div>
                <div class="data" data-url="{{route('category-blog.list')}}">
                    <div class="list-category-blogs"></div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pages.category-blog.create')
    @include('admin.pages.category-blog.edit')
@endsection
@section('script')
    <script src="{{ asset('admin-assets/js/category-blog/category.js') }}"></script>
@endsection
