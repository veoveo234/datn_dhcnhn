<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin-assets-old/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Đăng nhập</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 center border-box">
            @if(session()->has('notify'))
                <div class="alert alert-danger">{{ session()->get('notify') }}</div>
            @endif
            <h3 class="login-heading mb-4">Đăng nhập</h3>
            <form action="{{ route('admin.checkLogin') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Địa chỉ email</label>
                    <input type="email" id="email" value="{{ old('email') }}" name="email" class="form-control @error('email') border-error @enderror" autofocus>
                    @error('email')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') border-error @enderror">
                    @error('password')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Nhớ mật khẩu</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
                        type="submit">Đăng nhập
                </button>
                <div class="text-center">
                    <a class="small" href="#">Quên mật khẩu?</a></div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('admin-assets-old/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('admin-assets-old/js/sweetalert2@10.js') }}"></script>
<script src="{{ asset('admin-assets-old/js/setting.js') }}"></script>
<script src="{{ asset('admin-assets-old/js/project/project.js') }}"></script>
</body>
</html>
