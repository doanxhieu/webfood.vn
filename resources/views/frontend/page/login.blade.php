@extends('frontend.master')
@section('title','Login')
@section('content') 
@section('css')
<link rel="stylesheet" type="text/css" href="source/css/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

@endsection
<section class="login-block">
    <div class="container containerlogin">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Login Now</h2>
                @if(session('err'))
                <div><a href="javascript:void(0);" style="color:red;">{{session('err')}}</a></div>
                @endif
                <form class="login-form" method="post" action="{{route('postlogin')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                        <input type="text" class="form-control {{$errors->has('email')?'is-invalid':''}}" name="email" placeholder="Email..." value="{{old('email')}}">
                        @if ($errors->has('email'))
                        <div class="invalid-feedback" >
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                        <input type="password" class="form-control {{$errors->has('password')?'is-invalid':''}}" name="password" placeholder="Password..." value="{{old('password')}}">
                        @if ($errors->has('password'))
                        <div class="invalid-feedback" >
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-check form-group">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="remember">
                            <small>Remember Me</small>
                        </label>
                        <label for="" class="float-right"><a href="javascript:void(0);" id="example2-2">Quên mật khẩu?</a></label>
                        <button type="submit" class="btn btn-login float-right" style="clear: right;margin-bottom: 25px;"><i class="fa fa-sign-in"></i> Đăng nhập</button>
                    </div>
                    
                    <div class="form-group clearfix">
                        <div style="margin-bottom: 20px;">
                            <a href="" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                            Facebook</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                </div>  
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                </div>  
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script type="text/javascript">
        function validate_Email(sender_email) {
            var expression = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
            if (expression.test(sender_email)) {
                return true;
            }
            else {
                return false;
            }
        };
        $('#example2-2').click(function() {
            $.confirm({
                title: 'Prompt!',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Email đăng nhập:</label>' +
                '@csrf'+
                '<input type="email" placeholder="Your email..." class="name form-control" required />' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name = this.$content.find('.name').val();
                            token = $('meta[name="csrf-token"]').attr('content');
                            if(!name){
                                // $.alert('provide a valid name');
                                $.alert('Mời bạn nhập email: để nhận lại mật khẩu!');
                                return false;
                            }else{
                                if (validate_Email(name)) {
                                    $.ajax({
                                        url: 'http://shoplaravel.local.com/login/resetpassword',
                                        type: 'post',
                                        dataType: 'json',
                                        data: {email: name, token: token},
                                    })
                                    .done(function(data) {
                                        $.alert('Kiểm tra email: '+data.email+ ' của bạn để tiếp tục sử dụng hệ thống!');
                                    });

                                }
                                else {
                                    $.alert('Địa chỉ email không hợp lệ!');
                                    return false;
                                }
                            }
                            // $.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
            //close
        },
    },
    onContentReady: function () {
        // bind to events
        var jc = this;
        this.$content.find('form').on('submit', function (e) {
            // if the user submits the form by pressing enter in the field.
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); // reference the button and click it
        });
    }
});
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {

            $('.check').click(function() {
                alert('ok');
                /* Act on the event */
                swal({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                  if (result.value) {
                    swal(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                      )
                }
            });
          });
        });
    </script>
    @endsection
