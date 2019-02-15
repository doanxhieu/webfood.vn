<section class="newproduct bgwhite p-t-45 p-b-105">
	<div class="container">
		<div class="sec-title p-b-60">
			<h3 class="m-text5 t-center">
				Featured Products
			</h3> 
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">
				@foreach($new_product as $value)
				@php
				$str_img = $value->photo;
				$arr_img = explode('__', $str_img);
				@endphp
				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
							<div class="block2-img wrap-pic-w of-hidden pos-relative {{$value->promotion_price >0 ? 'block2-labelsale':''}}">
								<img src="{{asset('upload/products')}}/{{$arr_img[0]}}" alt="IMG-PRODUCT" class="rounded mx-auto d-block img-fluid" style="height: 300px;">
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
								<a href="{{route('frontend.product.detail',$value->slug)}}" class="block2-name dis-block s-text3 p-b-5">
									{{is_null($value->translation('en')->first())?($value->translation('vi')->first()->title):($value->translation()->first()->title)}}
								</a>
								@if($value->promotion_price==0)
								<span class="block2-price m-text6 p-r-5">
									{{number_format($value->price)}}
									<strong style="color:#F00;">VND</strong>
								</span>
								@else
								<span class="block2-oldprice m-text7 p-r-5">
									{{number_format($value->promotion_price)}}
								</span>
								<span class="block2-price m-text6 p-r-5">
									{{number_format($value->price)}}
									<strong style="color:#F00;">VND</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
