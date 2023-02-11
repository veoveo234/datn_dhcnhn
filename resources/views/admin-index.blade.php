<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin/includes.head')
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			@include('admin/includes.header')
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			@include('admin/includes.sidebar')
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			@yield('content')
		</div>
		
		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template">
			@include('admin/includes.settings')
		</div>
		<!-- End Custom template -->
	</div>
	@include('admin/includes.script')
	@yield('script')
</body>
</html>