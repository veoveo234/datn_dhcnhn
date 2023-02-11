@extends('index')
@section('content')
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h2 class="m-0 font-weight-bold text-primary">Update User</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="card mb-4 align-center" style="padding: 20px; margin-left: 225px">
                    <form action="{{ route('role.update', $role->id) }}" method="POST" id="form-add-product"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name : </label>
                            <input type="text" class="form-control" value="{{ $role->name }}" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <input type="text" class="form-control" value="{{ $role->description }}" id="description"
                                   name="description">
                        </div>
                        <label for="roles">Permission: </label>
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input type="checkbox"
                                       {{$permissionAsOfRole->contains($permission->id) ? 'checked' : ''}}
                                       class="form-check-input" value="{{ $permission->id }}"
                                       id="permission" name="permissions[]">{{ $permission->description }}
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary add-product">
                            Update User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection

