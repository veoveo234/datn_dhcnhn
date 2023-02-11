@extends('index')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manager Roles</h1>
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
                    <h2 class="m-0 font-weight-bold text-primary">List Roles</h2>
                </div>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button style="width: 200px ;font-weight: bold" type="button" class="btn btn-success"
                            data-toggle="modal" data-target="#modal-add-product" id="#modal-add-product">Create Role
                    </button>
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
                <div class="table-responsive p-3 data-table">
                    <table class="table align-items-center table-flush table-hover data" style="text-align: center">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th colspan="3">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{  $role->name }}</td>

                                <td>{{ $role->description}}</td>
                                <td>
                                    <button type="button" data-id="{{ $role->id }}"
                                            data-url=""
                                            class="btn btn-info btn-detail-product">
                                        View
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning">
                                        Edit</a>
                                </td>
                                @if($role->name != 'admin')
                                <td>
                                    <button data-url="{{ route('role.delete', $role->id) }}" class="btn btn-danger delete-role">
                                        Delete</button>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="paginate">
        <div class="datas">{{ $roles->links() }}</div>
    </div>
    @include('admin.role.create')
@endsection
@section('script')
    <script src="{{ asset('assets/js/project/role/role.js')}}"></script>
@endsection
