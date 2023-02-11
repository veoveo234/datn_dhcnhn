@extends('index')
@section('cssPage')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endsection
@section('content')
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Bạn mới đến Shop?</h4>
							<p>Tạo một tài khoản mới</p>
							<a class="button button-account" href="{{ route('register-view') }}">Đăng ký ngay</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Đăng nhập</h3>
						<form class="row login_form" method="POST" action="{{ route('login') }}" id="contactForm" >
                            @csrf
                            @if(session()->has('login_failed'))
                                <div class="col-md-12 alert alert-danger">{{ session()->get('login_failed') }}</div>
                            @endif
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
							</div>
                            @error('email')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
                            @error('password')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
							<div class="col-md-12 form-group">
								<button type="submit" class="button button-login w-100">Đăng nhập</button>
								<a href="#">Quên mật khẩu?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
@endsection
