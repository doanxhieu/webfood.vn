@extends('admin.master')
@section('title','Quản lý người dùng')

@section('content')
@section('css')
<link rel="stylesheet" href="{{asset('admin_theme/plugins/iCheck/all.css')}}">
@endsection
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm tài khoản người dùng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">quanlynguoidung</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary" style="padding: 10px 10px;">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    @if(session()->has('not_success'))
                    <div class="alert alert-danger">{{session('not_success')}}</div>
                    @endif

                    <span class="text-red">* Là trường bắt buộc</span>
                </div>
                <div class="col-md-8 col-md-offset-2 col-xs-12">

                    <form action="{{route('admin.user.saveinsert')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email <span class="text-red">*</span></label>
                            <div class="{{$errors->has('email') ? 'has-error has-danger' : '' }}">
                                <input type="email" name="email" class="form-control" placeholder="Enter email..." value="{{old('email')}}">
                                <div class="help-block text-red">
                                    {{ $errors->first('email')}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="permissions" class="control-label">Quyền <span class="text-red">*</span> </label>
                            <div class="form-group {{$errors->has('permissions')?'has-error  has-danger':''}}">
                                <select name="permissions" id="role_user" class="form-control">
                                    <option value="">---Chọn quyền---</option>
                                    @foreach($role as $value)
                                    <option value="{{$value->slug}}" {{(old('role')==$value->slug)?'selected':''}}>{{$value->name}}</option>
                                    @endforeach
                                </select>                                   
                            </div>
                            @if ($errors->has('permissions'))
                            <div class="help-block text-red" >
                                {{ $errors->first('permissions') }}
                            </div>
                            @endif
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="firtname">Firt Name </label>
                            <input type="text" name="firstname" value="{{old('firstname')}}" class="form-control" placeholder="Enter firt name...">
                        </div>
                        <div class="form-group">
                            <label for="firtname">Last Name </label>
                            <input type="text" name="lastname" class="form-control" value="{{old('lastname')}}" placeholder="Enter firt name...">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="text-red">*</span></label>
                            <div class="{{$errors->has('password') ? 'has-error has-danger' : '' }}">
                                <input type="password" name="password" class="form-control" value="{{old('password')}}" placeholder="Enter password..." >
                            </div>
                            <div class="help-block text-red" >
                                {{ $errors->first('password') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confpassword">Password Confirmation <span class="text-red">*</span></label>
                            <div class="{{$errors->has('password') ? 'has-error has-danger' : '' }}">
                                <input type="password" name="password_confir" value="{{old('password_confir')}}" class="form-control" placeholder="Enter password...">
                            </div>
                            <div class="help-block text-red" >
                                {{ $errors->first('password_confir') }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> {{__('admin.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    @section('script')
    <script src="{{asset('admin_theme/plugins/iCheck/icheck.min.js')}}"></script>
    <script type="text/javascript">

        $(function(){

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
    });

</script>
@endsection
@endsection
