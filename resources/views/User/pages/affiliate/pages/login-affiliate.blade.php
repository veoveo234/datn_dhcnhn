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
	<style>
		.wizard-card .moving-tab{
			display: none;
		}
		.wizard-card .info-text{
			margin: 0;
			padding: 30px 0;
			background-color: #eee;
		}
	</style>
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
	    <div class="container" style="padding-top: 80px">
			@if(Session::has('error'))
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="alert alert-success alert-dismissible show" role="alert" style="font-size: 23px">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
                        @php echo session('error'); @endphp
					</div>
				</div>
			</div>
			@endif
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="green" id="wizardProfile">
		                    <form action="{{ route('partner.login') }}" method="POST">
								{{ csrf_field() }}
		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
										Đăng nhập Shop Affiliate
		                        	</h3>
		                    	</div>
								<div class="wizard-navigation">
									<ul style="display: none">
			                            <li><a href="#about" data-toggle="tab">About</a></li>
			                            <li><a href="#account" data-toggle="tab">Account</a></li>
			                            <li><a href="#address" data-toggle="tab">Address</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
		                              <div class="row">
		                                	<h4 class="info-text">Chào mừng bạn đến với Affiliate</h4>
		                                	<div class="col-sm-8 col-sm-offset-2">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                            <label class="control-label">Email <small>(required)</small></label>
			                                            <input name="email" type="email" class="form-control">
			                                        </div>
												</div>
		                                	</div>
		                                	<div class="col-sm-8 col-sm-offset-2">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">password</i>
													</span>
													<div class="form-group label-floating">
			                                            <label class="control-label">Password <small>(required)</small></label>
			                                            <input name="password" type="password" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>
		                            	</div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='submit' class='btn btn-next btn-fill btn-success btn-wd' name='login' value='Đăng nhập' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
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
