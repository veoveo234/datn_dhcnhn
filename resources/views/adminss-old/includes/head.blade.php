<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>World of business clothes - Admin</title>
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('admin-assets/img/icon.ico') }}" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="{{ asset('admin-assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {
            "families": ["Lato:300,400,700,900"]
        },
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ['{{ asset('admin-assets/css/fonts.min.css') }}']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });

</script>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.css">

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/css/atlantis.min.css') }}">

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('admin-assets/css/demo.css') }}">
 @yield('styles')
{{-- Date Range Picker --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


{{-- Ckeditor 4 --}}
<script src="{{ asset('admin-assets/ckd/ckeditor.js') }}"></script>

