<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin-@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="{{asset('admin_theme/dist/img/favicon-32x32.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin_theme/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin_theme/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin_theme/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin_theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_theme/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admin_theme/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('admin_theme/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    @yield('css')
    <link rel="stylesheet" href=" https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">
    .content .table .text-justify{
        vertical-align: middle;
        text-align: center;
    }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin.layout.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.layout.menuleft')
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        @include('admin.layout.modal')
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href=" https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <script src="{{asset('admin_theme/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin_theme/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_theme/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_theme/dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('admin_theme/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin_theme/dist/js/main.js')}}"></script>
    @yield('script')
    <script type="text/javascript">
        $('div.alert').delay(10000).slideUp();
    </script>
</body>
</html>
