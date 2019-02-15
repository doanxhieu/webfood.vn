<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="animsition">
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <section class="invoice">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i>ADMIN SHOP
                        </h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <p>Cảm ơn quý khách đã ủng hộ cửa hàng.</p>
                </div>
                <hr>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 col-lg-4 text-justify invoice-col">
                        From
                        <address>
                            <strong>Email:admin@gmail.com</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>

                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="">
                        To
                        <address>
                            @if(Sentinel::check())
                            <strong>{{Sentinel::getUser()->email}}</strong><br>
                            {{$address}}<br>
                            Phone:{{$phone}}<br>
                            @endif
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="">
                        <b>Invoice</b><br>
                        <br>
                        <b>Order ID:</b><br>
                        <b>Payment Due:</b> 2/22/2014<br>
                        <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- Table row -->
                @if(Cart::content()->isEmpty())
                <h3>trong</h3>
                @else
                <div class="row">
                    <div class="col-lg-12 col-xs-12 table-responsive">
                      <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>{{__('bill.sanpham')}}</th>
                                <th>{{__('bill.soluong')}}</th>
                                <th>{{__('bill.dongia')}} <strong>(VND)</strong></th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                            $stt=1;
                            ?>
                            @foreach(Cart::content() as $value)
                            <tr>
                                <td>{{$stt}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->qty}}</td>
                                <td>{{number_format($value->price)}}</td>
                            </tr>
                            <?php $stt++?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-lg-6 col-md-6">
                    <p class="lead">Payment Methods:</p>
                    <span>{{$payment}}</span>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-lg-6 col-md-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th style="width:50%">{{__('bill.subtotal')}}  <strong>(VNĐ)</strong>:</th>
                                <td>{{Cart::subtotal(0)}}</td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            @endif
        </section>
    </div>
</section>
</body>
</html>

