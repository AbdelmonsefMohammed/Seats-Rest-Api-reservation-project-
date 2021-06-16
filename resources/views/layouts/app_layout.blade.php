<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>My Seats</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="{{(asset('assets/plugins/simple-line-icons/simple-line-icons.min.css'))}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
	<!--bootstrap -->
	<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/material/material.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/material_style.css')}}">
    @yield('extra-css')
	<!-- animation -->
	<link href="{{asset('assets/css/pages/animate_page.css')}}" rel="stylesheet">
	<!-- Template Styles -->
    <link href="{{asset('assets/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/theme-color.css')}}" rel="stylesheet" type="text/css" />
    
	<!-- favicon -->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}" /> 
 </head>
 <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div id="page-wrapper">
        <!-- start header -->
        @include('components.header')
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            @include('components.sidebar')
            @yield('content')
       </div>
       <!-- end page container -->
        <!-- start footer -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2021 &copy; Created By Oncreation
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- end footer -->
    </div>
        <!-- start js include path -->
        <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}" ></script>
        <script src="{{asset('assets/plugins/popper/popper.min.js')}}" ></script>
        <script src="{{asset('assets/plugins/jquery-blockui/jquery.blockui.min.js')}}" ></script>
        <script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- bootstrap -->
        <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" ></script>
        <!-- counterup -->
        <script src="{{asset('assets/plugins/counterup/jquery.waypoints.min.js')}}" ></script>
        <script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}" ></script>
        <!-- Common js-->
        <script src="{{asset('assets/js/app.js')}}" ></script>
        <script src="{{asset('assets/js/layout.js')}}" ></script>
        <script src="{{asset('assets/js/theme-color.js')}}" ></script>
        @yield('extra-js')
        <!-- material -->
        <script src="{{asset('assets/plugins/material/material.min.js')}}"></script>
        <!-- animation -->
        <script src="{{asset('assets/js/pages/ui/animations.js')}}" ></script>
        
        <!-- end js include path -->
        @include('sweetalert::alert')

</body>
</html>
