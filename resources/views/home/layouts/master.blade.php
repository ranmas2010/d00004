<!DOCTYPE html>
<html>
	@include('home.layouts.partials.head')
	<body>
	<div class="page-wrapper">
		<!-- Preloader -->
		<div class="preloader"></div>

		@include('home.layouts.partials.header')



			@yield('content')


		@include('home.layouts.partials.footer')

		</div>
	@include('home.layouts.partials.footer_js')
	</body>
</html>
