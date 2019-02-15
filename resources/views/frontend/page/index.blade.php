@extends('frontend.master')
@section('content')
{{-- slide --}}
@include('frontend.layout.slide')
{{-- banner --}}
@include('frontend.layout.banner_home1')
{{-- New Product --}}
@include('frontend.layout.new_product_home')
{{-- Banner2 --}}
@include('frontend.layout.banner_home2')
{{-- Blog --}}
@include('frontend.layout.blog_home')

{{-- Instagram --}}
@include('frontend.layout.instagram_home')

<!-- Shipping -->
@include('frontend.layout.shipping_home')
@endsection
