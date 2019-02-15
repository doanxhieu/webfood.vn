	<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
					
				</div>

				<span class="topbar-child1">
					Free shipping for standard order over $100
				</span>
				<ul class="dropdown-menu">
					<li><a href="?lang=vi"><img class="flag" height="16px" src="{{asset('svg/vi.svg')}}" alt="Vietnam Flag"> Vietnamese</a></li>
					<li><a href="?lang=en"><img class="flag" height="16px" src="{{asset('svg/en.svg')}}" alt="United Kingdom Flag"> English</a></li>
				</ul>

				<div class="topbar-child2">
					<span class="topbar-email">
						@if(Sentinel::check())
						Xin chào: {{Sentinel::getUser()->email}}
						@endif
					</span>
					<div class="dropdown">
						<button class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Ngôn ngữ
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a href="?lang=vi"  class="dropdown-item"><img class="flag" height="16px" src="{{asset('svg/vi.svg')}}" alt="Vietnam Flag"> Vietnamese</a>
							<a href="?lang=en"  class="dropdown-item"><img class="flag" height="16px" src="{{asset('svg/en.svg')}}" alt="United Kingdom Flag"> English</a>
						</div>
					</div>
					<li id='lang'>
						@if(app()->getLocale())
						<a href="?lang=vi"><img class="flag" height="16px" src="{{asset('svg/'.app()->getLocale().'.svg')}}" alt="{{app()->getLocale()}}"></a>
						@endif
					</li>
				</div>
			</div>
			
			<div class="wrap_header">
				<!-- Logo -->
				<a href="index" class="logo">
					<img src="source/images/icons/logo.png" alt="IMG-LOGO">
				</a>
				
				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li class="{{Route::is('frontend.index') ? 'sale-noti' : ''}}">
								<a href="{{route('frontend.index')}}">Home</a>
							</li>
							
							<li class="{{Route::is('frontend.product.*') ? 'sale-noti' : ''}}">
								<a href="{{route('frontend.product.cate')}}">Sản phẩm</a>
								<ul class="sub_menu">
									@foreach ($category as $key => $value)
									<li><a href="{{route('frontend.product.cate',$value->slug)}}">
										{{$value->translation()->first()->name}}</a></li>
										@endforeach
									</ul>
								</li>

								<li class="{{Route::is('gioi-thieu') ? 'sale-noti' : ''}}">
									<a href="{{route('gioi-thieu')}}">Giới thiệu</a>
								</li>

								<li class="{{Route::is('lien-he') ? 'sale-noti' : ''}}">
									<a href="{{route('lien-he')}}">Liên hệ</a>
								</li>
							</ul>
						</nav>
					</div>
					<!-- Header Icon -->
					<div class="header-icons">
						<a href="{{route('register')}}" class="header-wrapicon1 dis-block " style="margin-right: 10px;">Đăng ký</a>
						@if(Sentinel::check())
						<a href="{{route('dang-xuat')}}" class="header-wrapicon1 dis-block" style="margin-right: 10px;">Đăng xuất</a>
						@else
						<a href="{{route('dang-nhap')}}" class="header-wrapicon1 dis-block" style="margin-right: 10px;">Đăng nhập</a>
						@endif
						<a href="javascript:void(0);" class="header-wrapicon1 dis-block">
							<img src="{{asset('source/images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
						</a>

						<span class="linedivide1"></span>

						<div class="header-wrapicon2">
							<img src="source/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							<span class="header-icons-noti" data_count="{{value($count_cart)}}" id="count_product_cart">{{value($count_cart)}}</span>

							<!-- Header cart noti -->
							<div class="header-cart header-dropdown">

								@if(Cart::content()->isEmpty())
								<ul class="header-cart-wrapitem" id="item-cart">
									<span id="empty-cart">Chưa có sản phẩm</span>
									<hr>
								</ul>
								@elseif($cart=Cart::content())
								<ul class="header-cart-wrapitem" id="item-cart">
									<?php $id_li=1; ?>
									@foreach($cart as $value_cart)
									<?php
									$img = $value_cart->options->image;
									?>
									<li class="header-cart-item" style="border-bottom: 1px solid #f3f3f3;">
										<div class="header-cart-item-img">
											<img src="{{asset('upload/products/')}}/{{$img}}" alt="image">
										</div>
										<div class="header-cart-item-txt">
											<a href="{{route('frontend.product.detail',$value_cart->options->slug)}}" class="header-cart-item-name">
												{{$value_cart->name}}
											</a>
											<span class="header-cart-item-info">
												<span id="qty_{{$id_li}}">{{$value_cart->qty}}</span> 
												x 
												<span id="price_{{$id_li}}">{{$value_cart->price}}</span> <strong style="color:red;">(VNĐ)</strong>
											</span>
										</div>
									</li>
									<?php $id_li++; ?>
									@endforeach

								</ul>
								@endif
								<div class="header-cart-total">
									Tổng: <span class="total-cart" id="total-cart">{{Cart::subtotal(0)}}</span>
									<strong style="color:red;">(VNĐ)</strong>
								</div>
								<div class="header-cart-buttons">
									<div class="header-cart-wrapbtn">
										<!-- Button -->
										<a href="{{route('cart.view')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											View Cart
										</a>
									</div>
									@if(Sentinel::check())
									<div class="header-cart-wrapbtn">
										<!-- Button -->
										<a href="{{route('cart.viewordered')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											View Ordered
										</a>
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Header Mobile -->
			<div class="wrap_header_mobile">
				<!-- Logo moblie -->
				<a href="index.html" class="logo-mobile">
					<img src="source/images/icons/logo.png" alt="IMG-LOGO">
				</a>

				<!-- Button show menu -->
				<div class="btn-show-menu">
					<!-- Header Icon mobile -->
					<div class="header-icons-mobile">
						<a href="#" class="header-wrapicon1 dis-block">
							<img src="source/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
						</a>

						<span class="linedivide2"></span>

						<div class="header-wrapicon2">
							<img src="source/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
							<span class="header-icons-noti">0</span>

							<!-- Header cart noti -->
							<div class="header-cart header-dropdown">
								<ul class="header-cart-wrapitem">
									<li class="header-cart-item">
										<div class="header-cart-item-img">
											<img src="source/images/item-cart-01.jpg" alt="IMG">
										</div>

										<div class="header-cart-item-txt">
											<a href="#" class="header-cart-item-name">
												White Shirt With Pleat Detail Back
											</a>

											<span class="header-cart-item-info">
												1 x $19.00
											</span>
										</div>
									</li>

									<li class="header-cart-item">
										<div class="header-cart-item-img">
											<img src="source/images/item-cart-02.jpg" alt="IMG">
										</div>

										<div class="header-cart-item-txt">
											<a href="#" class="header-cart-item-name">
												Converse All Star Hi Black Canvas
											</a>

											<span class="header-cart-item-info">
												1 x $39.00
											</span>
										</div>
									</li>

									<li class="header-cart-item">
										<div class="header-cart-item-img">
											<img src="source/images/item-cart-03.jpg" alt="IMG">
										</div>

										<div class="header-cart-item-txt">
											<a href="#" class="header-cart-item-name">
												Nixon Porter Leather Watch In Tan
											</a>

											<span class="header-cart-item-info">
												1 x $17.00
											</span>
										</div>
									</li>
								</ul>

								<div class="header-cart-total">
									Total: $75.00
								</div>

								<div class="header-cart-buttons">
									<div class="header-cart-wrapbtn">
										<!-- Button -->
										<a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											View Cart
										</a>
									</div>

									<div class="header-cart-wrapbtn">
										<!-- Button -->
										<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											Check Out
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</div>
				</div>
			</div>

			<!-- Menu Mobile -->
			<div class="wrap-side-menu" >
				<nav class="side-menu">
					<ul class="main-menu">
						<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
							<span class="topbar-child1">
								Free shipping for standard order over $100
							</span>
						</li>

						<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
							<div class="topbar-child2-mobile">
								<span class="topbar-email">
									fashe@example.com
								</span>

								<div class="topbar-language rs1-select2">
									<select class="selection-1" name="time">
										<option>USD</option>
										<option>EUR</option>
									</select>
								</div>
							</div>
						</li>

						<li class="item-topbar-mobile p-l-10">
							<div class="topbar-social-mobile">
								<a href="#" class="topbar-social-item fa fa-facebook"></a>
								<a href="#" class="topbar-social-item fa fa-instagram"></a>
								<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
								<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
								<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
							</div>
						</li>

						<li class="item-menu-mobile">
							<a href="index.html">Home</a>
							<ul class="sub-menu">
								<li><a href="index.html">Homepage V1</a></li>
								<li><a href="home-02.html">Homepage V2</a></li>
								<li><a href="home-03.html">Homepage V3</a></li>
							</ul>
							<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
						</li>

						<li class="item-menu-mobile">
							<a href="product.html">Shop</a>
						</li>

						<li class="item-menu-mobile">
							<a href="product.html">Sale</a>
						</li>

						<li class="item-menu-mobile">
							<a href="cart.html">Features</a>
						</li>

						<li class="item-menu-mobile">
							<a href="blog.html">Blog</a>
						</li>

						<li class="item-menu-mobile">
							<a href="about.html">About</a>
						</li>

						<li class="item-menu-mobile">
							<a href="contact.html">Contact</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>
