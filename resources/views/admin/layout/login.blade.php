<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../admin_theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../admin_theme/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../admin_theme/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin_theme/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../admin_theme/plugins/iCheck/square/blue.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="/"><b style="color: #ea412c;">ĐĂNG NHẬP QUẢN TRỊ</b></a>
        </div>
        <div class="register-box-body">
            @if(session('err'))
            <p class="login-box-msg " style="color: #ea412c">{{session('err')}}</p>
            @endif
            @if($errors->has('not_permissions'))
                <p class="login-box-msg " style="color: #ea412c">{{$errors->first('not_permissions')}}</p>
            @endif
            @if(session('null_mail_face'))
                <p class="login-box-msg " style="color: #ea412c">{{session('null_mail_face')}}</p>
            @endif

            <form method="post" action="{{route('admin.postlogin')}}" role="form">
                <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}} has-feedback">
                    <input type="text" class="form-control" name="email" placeholder="Enten email..." value="{{old('email')}}" autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('email'))
                    <div class="help-block" >
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}  has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password..." value="{{old('password')}}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                    <div class="help-block" >
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Nhớ mật khẩu
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="http://localhost:8000/admin/login/facebook" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                Facebook</a>
                <a href="{{route('login.provider','google')}}" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                Google+</a>
            </div>
            <a href="login.html" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 3 -->
    <script src="../admin_theme/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../admin_theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../../admin_theme/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' /* optional */
      });
    });
</script>
</body>
</html>
