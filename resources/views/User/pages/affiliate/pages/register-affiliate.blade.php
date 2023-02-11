<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>World of business clothes</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="icon" href="{{ asset('assets/img/logo001.png') }}" type="image/png">

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="{{ asset('assets/affiliate/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/affiliate/material-bootstrap-wizard.css') }}" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="{{ asset('assets/affiliate/demo.css') }}" rel="stylesheet" />
</head>

<body>
	<div class="image-container set-full-height" style="background-image: url('{{ asset('images/affiliate/landscape-4765322_1920.jpg') }}')">
	    <!--   Creative Tim Branding   -->
	    <a href="#">
	         <div class="logo-container">
	            <div class="logo">
	                <img src="{{ asset('images/affiliate/new_logo.png') }}">
	            </div>
	            <div class="brand">
	               Hiepp
	            </div>
	        </div>
	    </a>

		<!--  Made With Material Kit  -->
		<a href="#" class="made-with-mk">
			<div class="brand">HB</div>
			<div class="made-with">Made with <strong>Hiepp</strong></div>
		</a>


	    <!--   Big container   -->
	    <div class="container" style="padding-top: 60px">
			@if(Session::has('error'))
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="alert alert-danger alert-dismissible show" role="alert" style="font-size: 23px">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Error!</strong> Số điện thoại hoặc Email đã được đăng ký.
					</div>
				</div>
			</div>
			@endif
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="green" id="wizardProfile">
		                    <form action="{{ route('partner.register') }}" method="POST" enctype="multipart/form-data">
								{{ csrf_field() }}
		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
										Tạo tài khoản Shop Affiliate
		                        	</h3>
									<h5>Thông tin này sẽ cho chúng tôi biết thêm về bạn.</h5>
		                    	</div>
		                        <div class="tab-content">
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <div class="picture-container">
                                                <div class="picture">
                                                    <img src="images/affiliate/212bc90d.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                                    <input type="file" id="wizard-picture" name="avatar" accept="image/*">
                                                </div>
                                                <h6>Choose Picture</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                  <label class="control-label">Họ <small>(*)</small></label>
                                                  <input name="firstname" type="text" value="{{ old('firstname') }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">record_voice_over</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                  <label class="control-label">Tên <small>(*)</small></label>
                                                  <input name="lastname" type="text" value="{{ old('lastname') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Địa chỉ email <small>(*)</small></label>
                                                    <input name="email" type="email" value="{{ old('email') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">business_center</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Nghề nghiệp</label>
                                                    <input name="profession" value="{{ old('profession') }}" type="text" class="form-control @error('profession') is-invalid @enderror">
                                                </div>
                                                @error('profession')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">place</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Địa chi</label>
                                                    <input name="address" type="text" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror">
                                                </div>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">local_phone</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Số điện thoại</label>
                                                    <input name="phone" type="text" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
                                                </div>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">vpn_key</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Mật khẩu</label>
                                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">vpn_key</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Xác thực lại mật khẩu</label>
                                                    <input name="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror">
                                                </div>
                                                @error('password_confirm')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
		                        </div>
                                <button type='submit' class='btn btn-success' style="margin-left: 350px;">Đăng ký</button>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div><!-- end row -->
	    </div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	             Made with <i class="fa fa-heart heart"></i> by <a href="#">Hiepp</a>
	        </div>
	    </div>
	</div>

</body>
	<!--   Core JS Files   -->
    <script src="{{ asset('assets/affiliate/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/affiliate/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/affiliate/jquery.bootstrap.js') }}" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="{{ asset('assets/affiliate/material-bootstrap-wizard.js') }}"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="{{ asset('assets/affiliate/jquery.validate.min.js') }}"></script>

</html>
