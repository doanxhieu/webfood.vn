@extends('frontend.master')
@section('title','Giỏ hàng')
@section('css')
<style type="text/css" media="screen">
.cart-page-empty-image {
    margin: auto;
    background-position: 50%;
    background-size: cover;
    background-repeat: no-repeat;
    width: 20rem;
    height: 17.9rem;
    background-image: url(images/empt-cart.png);
}


</style>
@endsection
@section('content') 
<!-- Title Page -->
<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <div class="row">
            <div id="thongbao-cart" class="col-lg-12">
                @if(session('err_store'))
                <div class="alert alert-danger">{{session('err_store')}}</div>
                @endif
            </div>
        </div>
        <!-- Cart item -->
        @if($contentcart->isEmpty())
            <div class="cart-page-empty-image"></div>
            <div class="cart-page-empty-text text-center"><h3>Không có sản phẩm trong giỏ hàng</h3></div>
        @else
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
             <form  role="form" method="post">
                @csrf
                <table class="table-shopping-cart">
                    <thead>
                        <tr class="table-head">
                            <th class="column-1"></th>
                            <th class="column-2">Product</th>
                            <th class="column-3">Price <strong style="color:red;">(VNĐ)</strong></th>
                            <th class="column-4 p-l-70">Quantity</th>
                            <th class="column-5">Total <strong style="color:red;">(VNĐ)</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $stt =1;?>
                       @foreach($contentcart as $value_cart)
                       <tr class="table-row_{{$value_cart->id}}" data-rowId="{{$value_cart->rowId}}" id="tr_{{$stt}}" data-idsp="{{$value_cart->id}}">
                        <td class="column-1">
                            <?php
                            $img = $value_cart->options->image;
                            $images = explode("__", $img);
                            ?> 
                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                <img src="{{asset('upload/products/')}}/{{$images[0]}}" alt="IMG-PRODUCT" id="del_product_cart_{{$value_cart->id}}">
                            </div>
                        </td>
                        <td class="column-2">{{$value_cart->name}}</td>
                        <td class="column-3">{{$value_cart->price}}</td>
                        <td class="column-4">
                            <div class="flex-w bo5 of-hidden w-size17">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2"  data-id="{{$value_cart->id}}">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>
                                {{-- <input class="size8 m-text18 t-center num-product" type="number" name="num-product1" id="num_product_{{$value_cart->id}}" value="{{$value_cart->qty}}" disabled> --}}
                                <span class="size8 m-text18 t-center num-product" id="num_product_{{$value_cart->id}}" style="padding-top: 12px;">
                                    {{$value_cart->qty}}
                                </span>

                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" data-id="{{$value_cart->id}}" >
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                        <td class="column-5 thanhtien_{{$stt}}" id="thanhtien_{{$value_cart->id}}">{{($value_cart->qty*$value_cart->price)}}</td>
                    </tr>   
                    <?php $stt++; ?>
                    @endforeach 
                </tbody>

            </table>
        </form>
    </div>
</div>
<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
    <div class="flex-w flex-m w-full-sm">
        <div class="size11 bo4 m-r-10">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
        </div>

        <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
            <!-- Button -->
            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                Apply coupon
            </button>
        </div>
    </div>

        {{-- <div class="size10 trans-0-4 m-t-10 m-b-10">
            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="btn-update-cart">
                Update Cart
            </button>
        </div> --}}
        <div class="size10 trans-0-4 m-t-10 m-b-10">
            <!-- Button -->
            <button class="flex-c-m sizefull hov1 bo-rad-23" id="btn-destroy-cart"
            style="border: 1px solid #e65540;">
            Xóa giỏ hàng
        </button>
    </div>
</div>
<!-- Total -->

<div class="row">
    <div class="col-lg-6">
        <form id="frm-store-cart" action="{{route('cart.storecart')}}" method="post">
            @csrf
            <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                <span class="s-text18 w-size19 w-full-sm">
                    Shipping:
                </span>
                <div class="w-size20 w-full-sm">
                    <p class="s-text8 p-b-23">
                        Vui lòng nhập thông tin giao hàng của bạn hoặc liên hệ với chúng tôi trước khi đồng ý mua hàng.
                    </p>
                    <span class="s-text18 w-size19 w-full-sm">
                        Địa chỉ giao hàng:
                    </span>
                    <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden m-t-12 m-b-12">
                        <select class="select-address form-control " name="tinhthanh" id="tinhthanh" required>
                            <option value="">---Chọn tỉnh---</option>
                            @foreach($tinh as $t)
                            <option value="{{$t->matp}}">{{$t->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden m-t-8 m-b-12">
                        <select class="select-address form-control" name="quanhuyen" id="quanhuyen" required>
                            <option value="">---Quận huyện---</option>
                        </select>
                    </div>
                    <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden m-t-8 m-b-12">
                        <select class="select-address form-control" name="xa" id="xaphuong" required>
                            <option value="">---Xã/phường/thị trấn---</option>
                        </select>
                    </div>
                </div>
                <span>Đường/Số nhà: </span>
                <div class="w-size20 w-full-sm form-group">
                    <textarea name="detail_add" rows="3" class="form-control" id="detail_add" required></textarea>
                </div>
                <span>Số điện thoại: </span>
                <div class="w-size20 w-full-sm form-group">
                    <input type="number" class="form-control" placeholder="Phone..." name="phone_number" id="phone" required>
                </div>
                <span>Hình thức thanh toán</span>
                <div class="w-size20 w-full-sm">
                    <label><input type="radio" name="payment" checked="true"  value="Thanh toán khi nhận hàng"> Thanh toán khi nhận hàng</label> 
                    <label><input type="radio" name="payment"  value="Thanh toán khi trực tuyến"> Thanh toán khi trực tuyến</label>
                </div>
            
                <div class="size14 trans-0-4 m-b-10">
                    <!-- Button -->
                    @if(Sentinel::check())
                    <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="store_cart" type="submit">
                        Đặt hàng
                    </button>
                    @else
                        <a href="{{route('dang-nhap')}}" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="login-to-cart"> Đặt hàng</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-6">
        <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <h5 class="m-text20 p-b-24">
                Cart Totals
            </h5>
            <!--  -->
            <div class="flex-w flex-sb-m p-b-12">
                <span class="s-text18 w-size19 w-full-sm">
                    Subtotal: 
                </span>
                <span class="m-text21 w-size20 w-full-sm">
                    <span id="total_cart">{{$total}}</span>
                    <strong style="color:red;">(VNĐ)</strong>
                </span>
                <span class="s-text18 w-size19 w-full-sm">
                    Bằng chữ: 
                </span>
                <span class="m-text21 w-size20 w-full-sm">

                </span>
            </div>
        </div>
    </div>
</div>

@endif
</div>
</section>
@section('script')
    <script type="text/javascript" src="{{asset('source/js/cart.js')}}"></script>
    <script type="text/javascript" src="{{asset('source/js/address.js')}}"></script>

@endsection
@endsection
