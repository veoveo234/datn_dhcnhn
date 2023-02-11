@extends('index')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manager Users</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active" aria-current="page">DataTables</li>
        </ol>
    </div>
    <!-- Row -->
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h2 class="m-0 font-weight-bold text-primary">List Users</h2>
                </div>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button style="width: 200px ;font-weight: bold" type="button" class="btn btn-success new-user"
                            data-toggle="modal" data-target="#modal-add-user" id="#modal-add-user">Create User
                    @if (session()->has('notify'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session()->get('notify') }}
                        </div>
                    @endif
                </div>
                <div class="noti-success" style="margin-left:50px">
                </div>
                <div class="table-responsive p-3 data-table data-user" data-url="{{route('user.list')}}">
                    <div class="list-user"></div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.user.create')
@endsection
@section('script')
    <script src="{{ asset('assets/js/project/user/user.js')}}"></script>
@endsection
