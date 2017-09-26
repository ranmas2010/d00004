<!--Involved Section-->
<section class="involved-section">
	<div class="auto-container">
		<div class="involved-inner wow fadeInUp" style="background-image:url(images/background/pattern-3.png);">
			<div class="row clearfix">
				<div class="column col-md-8 col-sm-12 col-xs-12">
					<h2>我們的最新活動與相關公告!</h2>
				</div>
				<div class="btn-column col-md-4 col-sm-12 col-xs-12">
					<a href="/news" class="theme-btn btn-style-one">Get Involved</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--End Involved Section-->

<!--Main Footer-->
<footer class="main-footer" style="background-image:url(images/background/pattern-2.png);">
	<div class="auto-container">
		<!--widgets section-->
		<div class="widgets-section">
			<div class="row clearfix">

				<!--Big Column-->
				<div class="big-column col-md-6 col-sm-12 col-xs-12">
					<div class="row clearfix">
						<!--Footer Column-->
						<div class="footer-column col-md-6 col-sm-6 col-xs-12">
							<div class="footer-widget logo-widget">
								<div class="footer-logo">
									<a href="index.html"><img src="/images/logo.png" alt="" /></a>
								</div>
								<div class="widget-content">
									<div class="text">享受最純粹『玩』的本質，以人與人的互動，啓動桌遊的魔幻空間。你今天！桌遊了沒</div>
									<ul class="social-links-two">
										@if(!empty($webData['facebook']))
										<li class="facebook"><a href="{{$webData['facebook']}}" target="_blank"><span class="fa fa-facebook"></span></a></li>
											@endif
										@if(!empty($webData['twitter']))
										<li class="twitter"><a href="{{$webData['twitter']}}" target="_blank"><span class="fa fa-twitter"></span></a></li>
											@endif
										@if(!empty($webData['google_plus']))
										<li class="google-plus"><a href="{{$webData['google_plus']}}" target="_blank"><span class="fa fa-google-plus"></span></a></li>
											@endif
										@if(!empty($webData['instagram']))
										<li class="linkedin"><a href="{{$webData['instagram']}}" target="_blank"><span class="fa fa-instagram"></span></a></li>
											@endif

									</ul>
								</div>
							</div>
						</div>

						<!--Footer Column-->
						<div class="footer-column col-md-6 col-sm-6 col-xs-12">
							<!--Links Widget-->
							<div class="footer-widget links-widget">
								<div class="footer-title">
									<h2>快速導引</h2>
								</div>
								<div class="widget-content">
									<ul class="list">
										<li><a href="/">首頁</a></li>
										<li><a href="/about">關於我們</a></li>
										<li><a href="/gallery">活動相簿</a></li>
										<li><a href="/news">最新消息</a></li>
										<li><a href="/contact">聯絡我們</a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>

				<!--Big Column-->
				<div class="big-column col-md-6 col-sm-12 col-xs-12">
					<div class="row clearfix">

						<!--Footer Column-->
						<div class="footer-column col-md-6 col-sm-6 col-xs-12">
							<!--Links Widget-->
							<div class="footer-widget links-widget">
								<div class="footer-title">
									<h2>作品專區</h2>
								</div>
								<div class="widget-content">
									<ul class="list">
										@foreach ($productCategorys as $col)
											<li><a href="/works/1/{{$col['guid']}}">{{$col['title']}}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>

						<!--Footer Column-->
						<div class="footer-column col-md-6 col-sm-6 col-xs-12">

							<div class="footer-widget subscribe-widget">
								<div class="footer-title">
									<h2>訂閱電子報</h2>
								</div>
								<div class="widget-content">
									<div class="newsletter-form">
										<form method="post" action="">
											<div class="form-group">
												<input type="text" name="name" value="" placeholder="Name *" required="">
											</div>
											<div class="form-group">
												<input type="email" name="email" value="" placeholder="Email Id" required="">
											</div>
											<div class="form-group">
												<button type="submit" class="theme-btn btn-style-one">SUBSCRIBE</button>
											</div>
										</form>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>

			</div>
		</div>

		<!--Footer Bottom-->
		<div class="footer-bottom">
			<div class="row clearfix">
				<div class="column col-md-6 col-sm-6 col-xs-12">
					<div class="copyright">&copy; Copyrights 2017 上曜創意工作室. All Rights Reserved</div>
				</div>
				<div class="column col-md-6 col-sm-6 col-xs-12">
					<!--<div class="cards"><img src="/images/icons/visa-cards.png" alt="" /></div>-->
				</div>
			</div>
		</div>

	</div>
</footer>