<header class="main-header">

	<!-- Header Top -->
	<div class="header-top">
		<div class="auto-container clearfix">
			<!--Top Left-->
			<div class="top-left pull-left">
				<ul class="links-nav clearfix">
					<li><span class="icon fa fa-envelope-o"></span><a href="#1">{{$webData['email']}}</a></li>
					<li><span class="icon fa fa-phone"></span><a href="tel:{{$webData['phone']}}">客服專線 : {{$webData['phone']}}</a></li>
				</ul>
			</div>

			<!--Top Right-->
			<div class="top-right pull-right">
				<ul class="links-nav clearfix">
					<li class="language dropdown"><a class="btn btn-default dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#">Tw &ensp;<span class="icon fa fa-caret-down"></span></a>
						<ul class="dropdown-menu style-one" aria-labelledby="dropdownMenu2">
							<li><a href="#">繁體中文</a></li>
							<li><a href="/en">English</a></li>

						</ul>
					</li>
					@if(Session::has('memberData'))
						<li><a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> 登出</a></li>
						<li><a href="/my-account"><i class="fa fa-user" aria-hidden="true"></i> 會員專區</a></li>
						@else
						<li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> 登入</a></li>
						<li><a href="/register"><i class="fa fa-user-plus" aria-hidden="true"></i> 加入會員</a></li>
						@endif



					<li><a href="#1" class="cart-icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> 購物車<span class="shopCarCount">{{count($shopList)}}</span></a>

						<div class="mini-cart-brief" id="topCarArea" 	@if(count($shopList) == 0) style="display: none;" @endif>

							<div class="items-label">
								<p class="mb-0"><i class="fa fa-info-circle" aria-hidden="true"></i> 您有 <span class="item_num shopCarCount">{{count($shopList)}}</span> 個商品在購物車中</p>
								<hr>
							</div>

							<div class="all-cart-product clearfix" id="topShopCarList">

								@foreach ($shopList as $col)
									<div class="single-cart clearfix">
										<div class="cart-photo">
											<a href="/work/{{$col['puid']}}" title="{{$col['productTitle']}}"><img src="{{$col['productPic']}}" alt="{{$col['productTitle']}}" /></a>
										</div>
										<div class="cart-info">
											<h5><a href="/work/{{$col['puid']}}" title="{{$col['productTitle']}}">{{mb_substr($col['productTitle'],0,10)}}...</a></h5>
											<p class="mb-0">單價 : NT$ {{$col['price']}}</p>
											<p class="mb-0">數量 : {{$col['qty']}} </p>
											<span class="cart-delete"><a href="#1" class="delShopCar" data-puid="{{$col['puid']}}"><i class="fa fa-times fa-3" aria-hidden="true"></i></a></span>
										</div>
									</div>
								@endforeach


							</div>
							<div class="cart-totals">
								<h5 class="mb-0">總計 <span class="floatright">NT$ <span class="vTotalPrice">{{$shopTotalPrice}}</span></span></h5>
							</div>
							<div class="cart-bottom  clearfix">
								<a href="/car" class="button-one floatleft  text-uppercase" style="font-size: 16px; color: #000000;" data-text="Check out">前往購物車</a>
								<a href="/checkout" class="button-one  floatright text-uppercase" style="font-size: 16px; color: #000000;" data-text="Check out">付款結帳</a>
							</div>
						</div>

					</li>







				</ul>
			</div>
		</div>
	</div>
	<!-- Header Top End -->

	<!--Header-Upper-->
	<div class="header-upper">
		<div class="auto-container">

			<div class="logo-outer">
				<div class="logo"><a href="/"><img src="/images/logo.png" alt="" title=""></a></div>
			</div>

			<div class="nav-outer clearfix">

				<!-- Main Menu -->
				<nav class="main-menu">
					<div class="navbar-header">
						<!-- Toggle Button -->
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="navbar-collapse collapse clearfix">
						<!--Left Nav-->
						<ul class="navigation left-nav clearfix">
							<li @if($uri == 'index') class="current" @endif><a href="/">首頁</a>

							</li>
							<li @if($uri == 'about') class="current" @endif><a href="/about">關於我們</a></li>
							<li class="dropdown @if($uri == 'works') current @endif "><a href="/works">作品專區</a>
								<ul>
									@foreach ($productCategorys as $col)
										<li><a href="/works/1/{{$col['guid']}}">{{$col['title']}}</a></li>
									@endforeach
								</ul>
							</li>
							<li class="dropdown"><a href="#">Pages</a>
								<ul>
									<li><a href="teachers.html">Teachers</a></li>
									<li><a href="features.html">Features</a></li>
									<li><a href="error-page.html">404 Page</a></li>
								</ul>
							</li>
						</ul>
						<!--Right Nav-->
						<ul class="navigation right-nav clearfix">
							<li @if($uri == 'gallery') class="current" @endif><a href="/gallery">活動寫真</a></li>
							<li class="dropdown @if($uri == 'news') current @endif "><a href="/news">最新消息</a>
								<ul>
									@foreach ($newsCategorys as $col)
										<li><a href="/news/1/{{$col->guid}}">{{$col->title}}</a></li>
									@endforeach
								</ul>
							</li>
							<li><a href="/contact">聯絡我們</a></li>

						</ul>
					</div>
				</nav>

				<!--Search Box-->
				<div class="search-box-outer">
					<div class="dropdown">
						<button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
						<ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
							<li class="panel-outer">
								<div class="form-container">
									<form method="post" action="/blog">
										<div class="form-group">
											<input type="search" name="field-name" value="" placeholder="Search Here" required="">
											<button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
										</div>
									</form>
								</div>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!--End Header Upper-->

	<!--Sticky Header-->
	<div class="sticky-header">
		<div class="auto-container clearfix">
			<!--Logo-->
			<div class="logo pull-left">
				<a href="/" class="img-responsive"><img src="/images/mozi logo-2.png" alt="" title=""></a>
			</div>

			<!--Right Col-->
			<div class="right-col pull-right">
				<!-- Main Menu -->
				<nav class="main-menu">
					<div class="navbar-header">
						<!-- Toggle Button -->
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="navbar-collapse collapse clearfix">
						<ul class="navigation clearfix">
							<li @if($uri == 'index') class="current" @endif><a href="/">首頁</a>

							</li>
							<li @if($uri == 'about') class="current" @endif><a href="/about">關於我們</a></li>
							<li class="dropdown @if($uri == 'works') current @endif"><a href="/works">作品專區</a>
								<ul>
									@foreach ($productCategorys as $col)
									<li><a href="/works/1/{{$col['guid']}}">{{$col['title']}}</a></li>
									@endforeach
								</ul>
							</li>
							<li class="dropdown"><a href="#">Pages</a>
								<ul>
									<li><a href="teachers.html">Teachers</a></li>
									<li><a href="features.html">Features</a></li>
									<li><a href="error-page.html">404 Page</a></li>
								</ul>
							</li>
							<li @if($uri == 'gallery') class="current" @endif><a href="/gallery">活動寫真</a></li>
							<li class="dropdown @if($uri == 'news') current @endif"><a href="/news">最新消息</a>
								<ul>
									@foreach ($newsCategorys as $col)
										<li><a href="/news/1/{{$col->guid}}">{{$col->title}}</a></li>
									@endforeach
								</ul>
							</li>
							<li><a href="/contact">聯絡我們</a></li>
							<li><a href="/my-account">會員專區</a></li>
							<li><a href="/car" class="cart-icon">購物車<span class="shopCarCount">{{count($shopList)}}</span></a></li>
						</ul>
					</div>
				</nav><!-- Main Menu End-->
			</div>

		</div>
	</div>
	<!--End Sticky Header-->

</header>