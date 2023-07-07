<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

	<title>ePraxis - Home</title>

	<!-- Standard Favicon -->
	<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

	<!-- For iPhone 4 Retina display: -->
	<link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/assets/images//apple-touch-icon-114x114-precomposed.png') }}">

	<!-- For iPad: -->
	<link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/assets/images//apple-touch-icon-72x72-precomposed.png') }}">

	<!-- For iPhone: -->
	<link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/assets/images//apple-touch-icon-57x57-precomposed.png') }}">

	<!-- Library - Google Font Familys -->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat+Alternates:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Playfair+Display:400,400i,700,700i,900,900i|Poppins:300,400,500,600,700|Quattrocento:400,700|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/revolution/css/settings.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/revolution/fonts/font-awesome/css/font-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/revolution/fonts/font-awesome/css/font-awesome.min.css') }}">

	<!-- RS5.0 Layers and Navigation Styles -->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/revolution/css/layers.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/revolution/css/navigation.css') }}">

	<!-- Library - Bootstrap v3.3.5 -->
    <link href="{{ asset('frontend/assets/css/lib.css') }}" rel="stylesheet">

	<link href="{{ asset('frontend/assets/js/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/js/slick/slick-theme.css') }}" rel="stylesheet">

	<!-- Custom - Common CSS -->
    <link href="{{ asset('frontend/assets/css/header.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/assets/css/plugins.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/assets/css/elements.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/assets/css/rtl.css') }}" rel="stylesheet">
	<link id="color" href="{{ asset('frontend/assets/css/color-schemes/default.css') }}" rel="stylesheet"/>

    @stack('plugin-styles')
	<!-- Custom - Theme CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/style.css') }}">

	<!--[if lt IE 9]>
		<script src="js/html5/respond.min.js"></script>
    <![endif]-->
    @stack('style')
</head>
<body data-base-url="{{url('/')}}" data-offset="200" data-spy="scroll" data-target=".ow-navigation">
    <div class="boxed-container" id="app">

        <div class="page-wrapper">
            @include('layout2.header')
            <div class="page-content">
                @yield('content')
            </div>
            @include('layout2.footer')
        </div>

    </div>
    <!-- JQuery v1.12.4 -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>

	<!-- Library - Js -->
	<script src="{{ asset('frontend/assets/js/lib.js') }}"></script>

	<!-- RS5.0 Core JS Files -->
	<script type="text/javascript" src="{{ asset('frontend/assets/revolution/js/jquery.themepunch.tools.min.js?rev=5.0') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/assets/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/assets/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>

	<script src="{{ asset('frontend/assets/js/slick/slick.min.js') }}"></script>

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

	<!-- Library - Google Map API -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW40y4kdsjsz714OVTvrw7woVCpD8EbLE"></script>

	<!-- Library - Theme JS -->
	<script src="{{asset('frontend/assets/js/functions.js')}}"></script>
    @stack('custom-scripts')
</body>
</html>
