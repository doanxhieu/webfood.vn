<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		MiniShop @yield('title')
	</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<base href="{{asset('')}}">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('source/images/icons/favicon.png')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/vendor/bootstrap/css/bootstrap.min.css')}}"> 
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/fonts/themify/themify-icons.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/fonts/elegant-font/html-css/style.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/vendor/animate/animate.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/vendor/css-hamburgers/hamburgers.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/vendor/animsition/css/animsition.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/vendor/select2/select2.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/vendor/daterangepicker/daterangepicker.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/vendor/slick/slick.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/vendor/lightbox2/css/lightbox.min.css')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('source/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('source/css/main.css')}}">
	<link type="text/javascript" src="{{asset('admin_theme/plugins/timepicker/bootstrap-timepicker.css')}}">
	@yield('css')
		<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('source/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	
</head>
<body class="animsition">

	@include('frontend.layout.header')

	@yield('content')

	@include('frontend.layout.footer')

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('source/vendor/animsition/js/animsition.min.js')}}"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('source/vendor/bootstrap/js/popper.js')}}"></script>
	<script type="text/javascript" src="{{asset('source/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('source/vendor/select2/select2.min.js')}}"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
		$('.select-address').select2();
	</script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('source/vendor/slick/slick.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('source/js/slick-custom.js')}}"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('source/vendor/countdowntime/countdowntime.js')}}"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('source/vendor/lightbox2/js/lightbox.min.js')}}"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('source/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('admin_theme/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
	<script type="text/javascript">
		    $('div.alert').delay(3000).slideUp();
	</script>
	<script src="{{asset('source/js/main.js')}}"></script>
	@yield('script');
</body>
</html>
