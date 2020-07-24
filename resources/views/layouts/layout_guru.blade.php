<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="Repaldiweb - Aplikasi U-Market">
	<meta name="author" content="Repaldiweb">
    <meta name="keyword" content="aplikasi u-market">
    
    @yield('title')

	<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/simple-line-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    <link rel="sortcut icon" href="{{ asset('assets/img/favicon.PNG') }}">
    
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('layouts.guru.header')
    <div class="app-body" id="dw">
        <div class="sidebar">
            @include('layouts.guru.sidebar')
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
        @yield('content')
        
    </div>

    <footer class="app-footer">
        <div>
            <a href="https://www.instagram.com/repaldi_hs/?hl=id">LIDM</a>
            <span>&copy; 2020 Universitas Jambi.</span>
            
        </div>
        <div class="ml-auto">
            <!-- <span>Powered by</span>
            <a href="https://www.instagram.com/repaldi_hs/?hl=id">....</a> -->
        </div>
    </footer>
    
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/coreui.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-tooltips.min.js') }}"></script>
    @yield('js')
    @yield('chart')
</body>
</html>