@extends('index')
@section('content')
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h2 class="m-0 font-weight-bold text-primary">Update User</h2>
    </div>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        @if (session()->has('noti'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session()->get('noti') }}
            </div>
        @endif
    </div>
    <div class="noti-success" style="margin-left:50px">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="card mb-4 align-center" style="padding: 20px; margin-left: 225px">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" id="form-add-product"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name : </label>
                            <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name"
                                   placeholder="Enter name...">
                        </div>
                        <div class="form-group">
                            <label for="roles">Role: </label>
                            <select class="form-control" id="roles" name="roles[]" multiple="multiple">
                                @foreach ($roles as $role)
                                    <option
                                        {{ $roleAsOfUser->contains($role->id) ? 'selected' : '' }}
                                        value="{{ $role->id }}">
                                        {{ $role->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary add-product">
                            Update User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

