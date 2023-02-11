@extends('index')

@section('cssPage')
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
@endsection

@section('content')
    <!--================Login Box Area =================-->
    <section class="login_box_area section-margin section-register">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Bạn có sẵn sàng để tạo một tài khoản mới?</h4>
                            <p>Bằng việc đăng kí, bạn đã đồng ý với Shop về Điều khoản dịch vụ & Chính sách bảo mật</p>
                            <a class="button button-account" href="{{ route('login-view') }}">Đăng nhập ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Đăng ký</h3>
                        <form class="row login_form" method="POST" action="{{ route('register')}}" enctype="multipart/form-data" id="register_form">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Họ và tên"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
                            </div>
                            @error('name')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                            <div class="col-md-12 form-group">
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="avatar" name="avatar" accept="image/*">
                                    <label class="custom-file-label text-left" for="avatar" style="color: #999">Ảnh đại diện</label>
                                </div>
                            </div>
                            @error('avatar')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email"
                                    placeholder="Email" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Email Address'">
                            </div>
                            @error('email')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="address" value="{{old('address')}}" name="address"
                                    placeholder="Địa chỉ" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Address'">
                            </div>
                            @error('address')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                            <div class="col-md-12 form-group">
                                <input type="number" class="form-control" id="phone" value="{{old('phone')}}" name="phone"
                                    placeholder="Số điện thoại" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Phone'">
                            </div>
                            @error('phone')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" value="{{old('password')}}" name="password"
                                    placeholder="Mật khẩu" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Password'">
                            </div>
                            @error('password')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="confirmPassword" value="{{old('password_confirmation')}}" name="password_confirmation"
                                    placeholder="Xác nhận mật khẩu" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Confirm Password'">
                            </div>
                            @error('password_confirmation')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                            <div class="col-md-12 form-group">
                                <button type="submit" class="button button-register w-100">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->

@endsection
@section('ajax')
<script>
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
@endsection
