<!-- Menu For Desktop Device -->
<div class="main-nav">
	<nav class="navbar navbar-expand-md navbar-light">
		<div class="container">
			<a class="navbar-brand" href="index.html">
				<img src="{{ asset('storage/'.setting('site.logo')) }}" alt="Logo">
			</a>
			<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">

				{{ menu('Main Menu', 'frontend.partials.menu', array('locale' => app()->getLocale())) }}

				<!-- Start Other Option -->
				<div class="others-option">
					<a class="call-us" href="tel:+009-8765-4332">
						<i class="bx bx-phone-call bx-tada"></i>
						+009 8765 4332
					</a>
				</div>
				<!-- End Other Option -->
			</div>
		</div>
	</nav>
</div>