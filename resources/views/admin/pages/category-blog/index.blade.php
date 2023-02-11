@extends('admin.layout.app')

@section('title')
    {{ trans('layout.admin.home.title') }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
@endsection

@section('script')

@endsection

@section('content')
    <div class="container-fluid mt-3">
        <div class="col-md-12">
            <div class="row mb-25">
                <div class="col-md-4 p-0 d-flex align-items-center">
                    <h3 class="text-dark font-weight-700">Quản lý danh mục bài viết</h3>
                </div>
                <div class="col-md-8 p-0 d-flex justify-content-end">
                    <a href="" class="d-flex justify-content-end align-items-center" style="width: 60px;" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row d-flex align-items-center bg-white m-0">
                    <div class="col-md-2 mt-25 mb-25">
                        <label class="my-input" for="status-active">Trạng thái</label>
                        <select name="status_active" id="status-active" class="form-control">
                            <option value="">Tất cả</option>
                            @foreach(STATUS_ACTIVE as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-25 mb-25">
                        <label class="my-input" for="name-cate">Tìm kiếm</label>
                        <input class="form-control" type="text" name="name_cate" id="name-cate" placeholder="nhập tên danh mục">
                    </div>
                    <div class="col-md-3 mt-25 mb-25 custom-search">
                        <div class="input-group">
                            <button class="btn btn-info search-store" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Table -->
        <div class="row mt-4">
            <div class="col-md-12 mb-5 p-0">
                <div class="table-responsive">
                    <table id="datatables" class="display table table-striped table-hover" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh danh mục</th>
                            <th>Tên danh mục </th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Chức năng</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.pages.category-blog.create')
    @include('admin.pages.category-blog.edit')
    @include('admin.pages.category-blog.confirm')

@endsection
@section('library-js')

@endsection
@section('after-js')
    <script>
        const page = {
            index_page : "{{ route('category-blog.index') }}",
            img_url : "{{ asset('storage/images/cate_blogs') }}",
            insert_url : "{{ route('category-blog.store') }}",
            delete_url : "/admin/category-blog/delete/",
            edit_url : "/admin/category-blog/edit/",
        }
    </script>
    <script src="{{ asset('admin_assets/js/category_blog.js') }}"></script>
@endsection
