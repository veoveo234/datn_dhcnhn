@extends('admin-index')
@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12">
                <!-- Button -->
                <div class="d-flex">
                    <button class="btn btn-primary btn-round mb-3" data-toggle="modal" data-target="#add-blog">
                        <i class="fa fa-plus"></i> Thêm mới blog
                    </button>
                </div>
                <!-- Modal -->
                <div class="data-url" data-url="{{ route('blog.list') }}">
                    <div class="list-blogs">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pages.blog.create')
@endsection
@section('script')
    <script src="{{ asset('admin-assets/js/project/blog.js') }}"></script>
@endsection
