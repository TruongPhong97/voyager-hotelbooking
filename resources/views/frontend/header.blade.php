{{-- @includeIf('frontend.partials.preloader') --}}
	
<!-- Start Ecorik Navbar Area -->
<div class="eorik-nav-style fixed-top">
	<div class="navbar-area">

		@include('frontend.partials.mobile-nav')

		@include('frontend.partials.main-nav')

	</div>
</div>
<!-- End Ecorik Navbar Area -->

@includeIf('frontend.partials.sidebar-modal')