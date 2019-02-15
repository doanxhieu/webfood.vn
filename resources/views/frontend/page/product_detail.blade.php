@extends('frontend.master')
@section('content')

<!-- breadcrumb -->
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
	<a href="{{route('frontend.index')}}" class="s-text16">
		Home
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
	</a>

	<a href="{{route('frontend.product.index')}}" class="s-text16">
		SanPham
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
	</a>

	<a href="#" class="s-text16">
		T-Shirt
		<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
	</a>

	<span class="s-text17">
		Boxy T-Shirt with Roll Sleeve Detail
	</span>
</div>
<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
	<div class="flex-w flex-sb">
		<div class="w-size13 p-t-30 respon5">
			<div class="wrap-slick3 flex-sb flex-w">
				<div class="wrap-slick3-dots"></div>
				@php
				$str_img = $chitietsp->photo;
				$arr_img = explode('__', $str_img);
				@endphp
				<div class="slick3">
					<div class="item-slick3" data-thumb="{{asset('upload/products/')}}/{{$arr_img[0]}}">
						<div class="wrap-pic-w">
							<img src="{{asset('upload/products/')}}/{{$arr_img[0]}}" alt="IMG-PRODUCT">
						</div>
					</div>

					<div class="item-slick3" data-thumb="{{asset('upload/products/')}}/{{$arr_img[0]}}">
						<div class="wrap-pic-w">
							<img src="{{asset('upload/products/')}}/{{$arr_img[0]}}" alt="IMG-PRODUCT">
						</div>
					</div>

					<div class="item-slick3" data-thumb="{{asset('upload/products/')}}/{{$arr_img[0]}}">
						<div class="wrap-pic-w">
							<img src="{{asset('upload/products/')}}/{{$arr_img[0]}}" alt="IMG-PRODUCT">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="w-size14 p-t-30 respon5">
			<h4 class="product-detail-name m-text16 p-b-13">
				{{$chitietsp->translation()->first()->title}}
			</h4>

			@if($chitietsp->promotion_price==null)
			{{number_format($chitietsp->price)}}
			<strong style="color:#F00;">VND</strong>
			@else
			{{number_format($chitietsp->price)}}
			<span class="block2-price m-text6 p-r-5">
				{{number_format($chitietsp->promotion_price)}}
				<strong style="color:#F00;">VND</strong>
			</span>
			@endif

			<p class="s-text8 p-t-10">

			</p>

			<!--  -->
			<div class="p-t-33 p-b-60">
				<div class="flex-m flex-w p-b-10">
					<div class="s-text15 w-size15 t-center">
						Kích cỡ
					</div>
					<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
						<select class="selection-2 form-control" name="size">
							<option>Choose an option</option>
							<option>Size S</option>
							<option>Size M</option>
							<option>Size L</option>
							<option>Size XL</option>
						</select>
					</div>
				</div>

				<div class="flex-m flex-w">
					<div class="s-text15 w-size15 t-center">
						Color
					</div>

					<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
						<select class="selection-2 form-control" name="color">
							<option>Choose an option</option>
							<option>Gray</option>
							<option>Red</option>
							<option>Black</option>
							<option>Blue</option>
						</select>
					</div>
				</div>

				<div class="flex-r-m flex-w p-t-10">
					<div class="w-size16 flex-m flex-w">
						<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
							<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
								<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
							</button>

							<input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

							<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
								<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
							</button>
						</div>

						<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
							<!-- Button -->
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Add to Cart
							</button>
						</div>
					</div>
				</div>
			</div>

			<div class="p-b-45">
				<span class="s-text8 m-r-35">SKU: MUG-01</span>
				<span class="s-text8">Categories: Mug, Design</span>
			</div>

			<!--  -->
			<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
				<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
					Description
					<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
					<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
				</h5>

				<div class="dropdown-content dis-none p-t-15 p-b-23">
					<p class="s-text8">
						{{$chitietsp->description}}
					</p>
				</div>
			</div>

			<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
				<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
					Additional information
					<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
					<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
				</h5>

				<div class="dropdown-content dis-none p-t-15 p-b-23">
					<p class="s-text8">
						Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
					</p>
				</div>
			</div>

			<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
				<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
					Reviews (0)
					<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
					<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
				</h5>

				<div class="dropdown-content dis-none p-t-15 p-b-23">
					<p class="s-text8">
						Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
					</p>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
	<div class="container">
		<div class="sec-title p-b-60">
			<h3 class="m-text5 t-center">
				Sản phẩm tương tự
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">

				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
							<img src="source/images/product/item-02.jpg" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								Herschel supply co 25l
							</a>

							<span class="block2-price m-text6 p-r-5">
								$75.00
							</span>
						</div>
					</div>
				</div>

				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative">
							<img src="source/images/product/item-03.jpg" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								Denim jacket blue
							</a>

							<span class="block2-price m-text6 p-r-5">
								$92.50
							</span>
						</div>
					</div>
				</div>

				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative">
							<img src="source/images/product/item-05.jpg" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								Coach slim easton black
							</a>

							<span class="block2-price m-text6 p-r-5">
								$165.90
							</span>
						</div>
					</div>
				</div>

				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
							<img src="source/images/product/item-07.jpg" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								Frayed denim shorts
							</a>

							<span class="block2-oldprice m-text7 p-r-5">
								$29.50
							</span>

							<span class="block2-newprice m-text8 p-r-5">
								$15.90
							</span>
						</div>
					</div>
				</div>

				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
							<img src="source/images/product/item-02.jpg" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								Herschel supply co 25l
							</a>

							<span class="block2-price m-text6 p-r-5">
								$75.00
							</span>
						</div>
					</div>
				</div>

				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative">
							<img src="source/images/product/item-03.jpg" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								Denim jacket blue
							</a>

							<span class="block2-price m-text6 p-r-5">
								$92.50
							</span>
						</div>
					</div>
				</div>

				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative">
							<img src="source/images/product/item-05.jpg" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								Coach slim easton black
							</a>

							<span class="block2-price m-text6 p-r-5">
								$165.90
							</span>
						</div>
					</div>
				</div>

				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
							<img src="source/images/product/item-07.jpg" alt="IMG-PRODUCT">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								Frayed denim shorts
							</a>

							<span class="block2-oldprice m-text7 p-r-5">
								$29.50
							</span>

							<span class="block2-newprice m-text8 p-r-5">
								$15.90
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
@endsection
