<!doctype html>
@php $currentLocale = app()->getLocale(); @endphp
<html lang="{{ str_replace('_', '-', $currentLocale) }}">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap Min CSS --> 
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
		<!-- Owl Theme Default Min CSS --> 
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.theme.default.min.css') }}">
		<!-- Owl Carousel Min CSS --> 
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}">
		<!-- Boxicons Min CSS --> 
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/boxicons.min.css') }}"> 
		<!-- Flaticon CSS --> 
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
		<!-- Meanmenu Min CSS -->
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/meanmenu.min.css') }}">
		<!-- Animate Min CSS --> 
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.min.css') }}">
		<!-- Nice Select Min CSS -->
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.min.css') }}">
		<!-- Odometer Min CSS -->
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/odometer.min.css') }}">
		<!-- Date Picker CSS-->
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/date-picker.min.css') }}">
		<!-- Magnific Popup Min CSS --> 
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.min.css') }}"> 
		<!-- Beautiful Fonts CSS --> 
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/beautiful-fonts.css') }}">
		<!-- Style CSS -->
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
		<!-- Responsive CSS -->
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
		<!-- Site CSS -->
		<link rel="stylesheet" href="{{ asset('assets/frontend/css/site.css') }}">
		<!-- Blade CSS -->
		@stack('css')
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{ asset('assets/frontend/img/favicon.png') }}">	
		<!-- TITLE -->
		<title>{{ setting('site.title') }}</title>	
	</head>

	<body>

		@include('frontend.header')

		@yield('content')

		@include('frontend.footer')

		<!-- Jquery Min JS -->
		<script data-cfasync="false" src="{{ asset('assets/frontend/js/email-decode.min.js') }}"></script>
		<script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script> 
		<!-- Bootstrap Bundle Min JS -->
		<script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
		<!-- Meanmenu Min JS -->
		<script src="{{ asset('assets/frontend/js/meanmenu.min.js') }}"></script>
		<!-- Owl Carousel Min JS -->
		<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
		<!-- Wow Min JS -->
		<script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
		<!-- Nice Select Min JS -->
		<script src="{{ asset('assets/frontend/js/nice-select.min.js') }}"></script>
		<!-- Magnific Popup Min JS -->
		<script src="{{ asset('assets/frontend/js/magnific-popup.min.js') }}"></script>
		<!-- Mixitup JS --> 
		<script src="{{ asset('assets/frontend/js/jquery.mixitup.min.js') }}"></script>
		<!-- Appear Min JS --> 
		<script src="{{ asset('assets/frontend/js/appear.min.js') }}"></script>
		<!-- Odometer Min JS --> 
		<script src="{{ asset('assets/frontend/js/odometer.min.js') }}"></script>
		<!-- Datepicker Min JS --> 
		<script src="{{ asset('assets/frontend/js/bootstrap-datepicker.min.js') }}"></script>
		<!-- Ofi Min JS --> 
		<script src="{{ asset('assets/frontend/js/ofi.min.js') }}"></script>
		<!-- jarallax Min JS --> 
		<script src="{{ asset('assets/frontend/js/jarallax.min.js') }}"></script>
		<!-- Form Validator Min JS -->
		<script src="{{ asset('assets/frontend/js/form-validator.min.js') }}"></script>
		<!-- Contact JS -->
		<script src="{{ asset('assets/frontend/js/contact-form-script.js') }}"></script>
		<!-- Ajaxchimp Min JS -->
		<script src="{{ asset('assets/frontend/js/ajaxchimp.min.js') }}"></script>
		<!-- Custom JS -->
		<script src="{{ asset('assets/frontend/js/custom.js') }}"></script>

		@stack('javascript')

    </body>

</html>