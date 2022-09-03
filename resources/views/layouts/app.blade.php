<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
		<meta name="author" content="Dreamguys - Bootstrap Admin Template">
		<meta name="robots" content="noindex, nofollow">
		<title>{{ config('app.name') }}</title>

		<link rel="shortcut icon" type="image/x-icon" href="{{asset('theme/assets/img/favicon.png')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/css/bootstrap.min.css')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/css/animate.css')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/css/dataTables.bootstrap4.min.css')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('theme/assets/plugins/fontawesome/css/all.min.css')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/css/style.css')}}">
		<!-- Dev Express Data Grid -->
		<link rel="stylesheet" href="{{asset('theme/assets/css/dx.light.css')}}?v=0.4"> 
        <!-- Custom login Stylesheet -->
        <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
	</head>
    <body>
        <!-- Authentication -->
        @guest
        <div id="top" class="login-bodycolor">
            <div class="login">
                <div class="login-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-info">
                                    <div class="form-section align-self-center">
                                        <div class="btn-section clearfix">
                            
                                        @if (Route::has('login'))
                                            <a href="{{ route('login') }}" class="link-btn active btn-1 active-bg default-bg">Login</a>
                                            @endif 
                                            @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="link-btn btn-2">Register</a>
                                            @endif
                                        </div>
                                        <div class="logo">
                                            <a href="{{ route('login') }}">
                                            <img src="{{asset('theme/assets/img/logo.png')}}" alt="logo">
                                        </a>
                                        </div>
                                        <h1>Welcome!</h1>

                                        @yield('login_content')
                                        <p>Help & Support</p>
                                        <div class="social-list">
                                            <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                            <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                            <a href="{{ url('auth/google') }}">
                                            <i class="fa fa-google"></i>
                                        </a>
                                            <a href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                            <a href="#">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                            <a href="#">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Ripple background start -->
            <div class="ripple-background">
                <div class="circle xxlarge shade1"></div>
                <div class="circle xlarge shade2"></div>
                <div class="circle large shade3"></div>
                <div class="circle mediun shade4"></div>
                <div class="circle small shade5"></div>
            </div>
            <!-- Ripple background end -->

            <!-- External JS libraries -->
            <!-- <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
            <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('js/jquery.validate.min.js')}}"></script>
            <script src="{{asset('js/app.js')}}"></script> -->
            <!-- Custom JS Script -->
        </div> 

        @else
        
        <!-- Pre-loader -->
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>
        <!-- End Preloader-->

        <!-- Start Header -->
        @include('includes.header')
        <!-- Header End -->

        <!-- Start Topbar -->
        @include('includes.top-nav')
        <!-- Topbar End -->

        <!-- Start Left Sidebar -->
        @include('includes.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!-- Page Content End -->

        <!-- Start Footer -->
        @include('includes.footer')
        <!-- Footer End -->

        @yield('script')

       @endguest
    </body>

    </html>

