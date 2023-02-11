@extends('admin-index')
@section('styles')
    <link href="{{ asset('admin-assets/css/project.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" style="margin: 20px auto;">
                <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <h3 class="title">Cập nhật thông tin </h3>
                    <div class="form-group">
                        <div class="avatar-wrapper">
                            <img class="profile-pic" src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('admin-assets/uploads/avatar.jpg') }}" alt=""/>
                            <div class="upload-button">
                                <i class="fas fa-camera" aria-hidden="true"></i>
                            </div>
                            <input class="file-upload" type="file" name="avatar" accept="image/*"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên :</label>
                        <input type="text" id="name" class="form-control input-profile" value="{{ old('name' , $user->name ?? '') }}" name="name"
                               placeholder="Nhập tên họ tên ...">
                        <span class="error-message">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="text" id="email" class="form-control input-profile" value="{{ old('email' , $user->email ?? '') }}" name="email"
                               placeholder="Nhập email ...">
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại :</label>
                        <input type="text" id="phone" class="form-control input-profile" value="{{ old('phone' , $user->phone ?? '') }}" name="phone"
                               placeholder="Nhập số điện thoại ...">
                        <span class="error-message">{{ $errors->first('phone') }}</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary center-block" > Lưu thông tin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/js/project/profile.js') }}"></script>
@endsection
