@extends('master')
@section('title','Liên hệ')
@section('content')
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(source/images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			Contact
		</h2>
	</section>
	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
                @if(session()->has('success'))
                <div class="alert alert-success"><strong>SUCCESSS! </strong>{{session('success')}}</div>
                @endif
				<div class="col-md-6 p-b-30">
					<div class="p-r-20 p-r-0-lg">
						<div class="contact-map size21" id="google_map"></div>
					</div>
				</div>
				<div class="col-md-6 p-b-30">
					<form class="leave-comment" action="{{route('post-lienhe')}}" method="post">
                        @csrf
						<h4 class="m-text26 p-b-36 p-t-15">
							Thông tin
						</h4>
                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control {{$errors->has('email')?'is-invalid':''}}" type="text" name="email" value="{{old('email')}}" placeholder="Enter Email...">
                            @if ($errors->has('email'))
                            <div class="invalid-feedback" >
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>
						<div class="form-group">
                            <label>Họ tên: </label>
							<input class="form-control {{$errors->has('fullname')?'is-invalid':''}}" type="text" name="fullname" placeholder="Full Name..." value="{{old('fullname')}}">
                            @if ($errors->has('fullname'))
                            <div class="invalid-feedback" >
                                {{ $errors->first('fullname') }}
                            </div>
                            @endif
						</div>

						<div class="form-group">
                            <label>Số điện thoại: </label>
							<input class="form-control {{$errors->has('phone')?'is-invalid':''}}" type="text" name="phone" placeholder="Phone Number..." value="{{old('phone')}}">
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                            @endif
						</div>
						
                        <div class="form-group">
                            <label>Nội dung: </label>
                            <textarea class="form-control {{$errors->has('message')?'is-invalid':''}}" name="message" rows="5">{{old('message')}}</textarea>
                            @if ($errors->has('message'))
                            <div class="invalid-feedback" >
                                {{ $errors->first('message') }}
                            </div>
                            @endif
                        </div>
						
    
						<div class="w-size25">
							<!-- Button -->
							<button type="submit" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
								Send
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

@section('script')
<script>
  function initMap() {
    var uluru = {lat: 21.0044303, lng: 105.812884};
    var map = new google.maps.Map(document.getElementById('google_map'), {
      zoom: 15,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
  }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKW05PCnjGpkyHDeIiBt-rnuwBBvKbdcw&callback=initMap"
type="text/javascript"></script>
@endsection
@endsection

