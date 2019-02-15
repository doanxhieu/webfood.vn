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
        <!-- Cart item -->
        @if($order->isEmpty())

        <div class="cart-page-empty-image"></div>
        <div class="cart-page-empty-text text-center"><h3>Bạn chưa có đơn hàng nào!</h3></div>
        <!-- Button -->
        <div class="text-center">
            <a href="{{route('frontend.index')}}" class="btn btn-success">
                Tiếp tục đặt hàng
            </a>
        </div>
        @else
        <div class="row">
            <div class="col-md-12">
                @if(session('success_store'))
                <div class="alert alert-success">{{session('success_store')}}</div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="info_cus" style="border: 1px solid #ccc;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Thông tin khách hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Email</td>
                                <td>{{Sentinel::getUser()->email}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-8">
                <div class="step-pay">
                    <h2 style="font-size: 18px;
                    padding: 8px 8px;
                    background: #fdd504;
                    line-height: 1.3em;
                    text-align: center;
                    margin: 0 auto;font-weight: 600;">Đơn hàng của bạn</h2>
                </div>
                <div style="border:1px solid #ccc;">
                    <table class="table table-hover">
                        <tbody>
                            @foreach($order as $value)
                            <tr  style="background: #ccc;">
                                <td colspan="2">Mã đơn hàng: {{$value->id}}</td>
                                <td class="text-right" style="color: #f33333;">Tình trạng:
                                    <span>
                                        @php 
                                        switch ($value->status) {
                                            case 0:
                                            echo 'Đang xử lý';
                                            break;
                                            case 1:
                                            echo 'Đang vận chuyển';
                                            break;
                                            case 3:
                                            echo 'Đơn hàng đã yêu cầu hủy';
                                            break;
                                        }
                                        @endphp
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th class="text-center">Số lượng đặt</th>
                                <th class="text-right">Thành tiền <span style="font-weight: 600; color: #f33333;">VNĐ</span></th>
                            </tr>
                            @foreach($value->bill_detail()->get() as $val)
                            <tr>
                                <td>
                                    @foreach($product as $vl)
                                    @if($vl->id == $val->product_id)
                                    {{($vl->translation()->first()->where('product_id',$val->product_id)->first()->title)}}
                                    @endif
                                    @endforeach
                                </td>
                                <td class="text-center">{{$val->quantity}}</td>
                                <td style="text-align:right; font-weight: 600;">{{number_format($val->amount)}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>Tổng tiền:</th>
                                <td></td>
                                <td style="text-align:right;font-weight: 600;">
                                    <span style="">{{number_format($value->total_amount*1000)}}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Địa chỉ giao hàng:</th>
                                <td></td>
                                <td>
                                    <span>{{$value->address}}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
