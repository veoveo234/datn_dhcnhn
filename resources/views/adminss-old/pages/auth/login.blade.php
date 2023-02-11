<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/login.css') }}">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-5 center border-box">
            <h3 class="login-heading mb-4">Login</h3>
            <form action="{{ route('admin.checkLogin') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" value="{{ old('email') }}" name="email" class="form-control" required
                           autofocus>
                    <span class="error-message">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <span class="error-message">{{ $errors->first('password') }}</span>
                </div>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
                        type="submit">Sign in
                </button>
                <a href="{{ route('admin.register') }}"
                   class="btn btn-lg btn-danger btn-block text-uppercase font-weight-bold mb-2"
                   type="submit">sign up
                </a>
                <div class="text-center">
                    <a class="small" href="#">Forgot password?</a></div>
            </form>
        </div>
        @if(session()->has('notify'))
            <input type="text" class="success-change-pass" style="display: none;"
                   value="{{ session()->get('notify')  }}">
        @endif
    </div>
</div>
<script src="{{ asset('admin-assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/sweetalert2@10.js') }}"></script>
<script src="{{ asset('admin-assets/js/setting.js') }}"></script>
<script src="{{ asset('admin-assets/js/project/project.js') }}"></script>
</body>
</html>
