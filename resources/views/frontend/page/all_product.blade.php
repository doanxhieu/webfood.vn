@extends('frontend.master')
@section('title','-Sản phẩm')
@section('css')
<style type="text/css">
#menu-left ul .li-cate:hover{
	background: #ccc;
}

</style>
@endsection
@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(source/images/heading-pages-02.jpg);">
	<h2 class="l-text2 t-center">
		Women
	</h2>
	<p class="m-text13 t-center">
		New Arrivals Women Collection 2018
	</p>
</section>

<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
	<div class="container">
		<div class="row">

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
				<div class="leftbar p-r-20 p-r-0-sm">
					<!--  -->
					<h4 class="m-text14 p-b-7">
						Danh mục
					</h4>
					<div id="menu-left">
						<ul class="p-b-54">
							@if(!empty($category))
							@foreach($category as  $value)
							<li class="p-t-4 li-cate">
								<a href="{{route('frontend.product.cate',$value->slug)}}" class="s-text13 active">
									{{$value->translation()->first()->name}}
								</a>
							</li>
							@endforeach
							@else
							<li class="p-t-4">
								<a href="#" class="s-text13 active1">
									Chưa có danh mục sản phẩm
								</a>
							</li>
							@endif
						</ul>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
				<!--  -->
				<div class="flex-sb-m flex-w p-b-35">
					<div class="flex-w">
						<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
							<select class="form-control" name="sorting">
								<option>Default Sorting</option>
								<option>Popularity</option>
								<option>Price: low to high</option>
								<option>Price: high to low</option>
							</select>
						</div>

						<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
							<select class="form-control" name="sorting" >
								<option>Price</option>
								<option>$0.00 - $50.00</option>
								<option>$50.00 - $100.00</option>
								<option>$100.00 - $150.00</option>
								<option>$150.00 - $200.00</option>
								<option>$200.00+</option>

							</select>
						</div>

						<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
							<input type="text" class="form-control" placeholder="Search name products...">
						</div>
					</div>

					<span class="s-text8 p-t-5 p-b-5">
						Showing 1–12 of 16 results
					</span>
				</div>

				<!-- Product -->
				<div class="row">
					@foreach($all_product as $value)
					@php 
					$str_img = $value->photo;
					$arr_img = explode('_', $str_img);
					@endphp
					<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
						<!-- Block2 -->
						<div class="block2">
							@if($value->promotion_price==0)
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								@else
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
									@endif
									<img src="{{asset('upload/products')}}/{{$arr_img[0]}}" alt="IMG-PRODUCT" class="rounded mx-auto d-block img-fluid" style="height: 300px;" >
									<div class="block2-overlay trans-0-4">
										<a href="{{route('frontend.product.detail',$value->slug)}}" class="block2-btn-addwishlist hov-pointer trans-0-4" >
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>
										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" data-id = "{{$value->id}}" data-price="{{($value->promotion_price==null)?$value->price:$value->promotion_price}}">
												Add to Cart
											</button>
										</div>
									</div>
								</div>
								<div class="block2-txt p-t-20">
									<a href="{{route('frontend.product.detail',$value->slug)}}" class="block2-name dis-block s-text3 p-b-5" style="font-weight: 600;">
										{{($value->translation('en')->first()->title == null)?($value->translation('vi')->first()->title):($value->translation('en')->first()->title)}}
									</a>
									@if($value->promotion_price==null)
									<span class="block2-price m-text6 p-r-5">
										<span class="block2-price_{{$value->id}}">{{$value->price}}</span>
										<strong style="color:#F00;">VND</strong>
									</span>
									@else
									<span class="block2-oldprice m-text7 p-r-5">
										{{$value->price}}
									</span>
									<span class="block2-price m-text6 p-r-5">
										{{$value->promotion_price}}
										<strong style="color:#F00;">VND</strong>
									</span>
									@endif
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="row">{{$all_product->links()}}</div>
				</div>
			</div>
		</div>
	</section>

	@section('script')
	<script type="text/javascript" src="{{asset('source/js/cart.js')}}"></script>
	@endsection
	@endsection
