<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>World of business clothes</title>

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> --}}

<link rel="icon" href="{{ asset('assets/img/logo001.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}">
<link href="{{ asset('admin_assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/themify-icons/themify-icons.css') }}">
@if(Request::is('cart'))
<link rel="stylesheet" href="{{ asset('assets/vendors/linericon/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/nouislider/nouislider.min.css') }}">
@endif
@if(!Request::is('women', 'men', 'index-affiliate/*'))
<link rel="stylesheet" href="{{ asset('assets/vendors/nice-select/nice-select.css') }}">
@endif
<link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.css') }}">
<link href="{{ asset('admin_assets/css/toastr.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


{{-- Date Range Picker --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@yield('content-head')

{{-- Ckeditor 4 --}}
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
