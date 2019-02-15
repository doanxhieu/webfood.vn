@extends('frontend.master')
@section('title','Register')
@section('content') 
@section('css')
<link rel="stylesheet" type="text/css" href="source/css/login.css">
@endsection
<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Register</h2>
                @if(session('register'))
                <div><a href="javascript:void(0);" style="color:red;">{{session('register')}}</a></div>
                @endif
                <form action="{{route('postregister')}}" method="POST" role="form">
                    @csrf 
                    <div class="form-group">
                        <legend>Register</legend>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @if($errors->has('email') || session('notregister') )
                        {{'is-invalid'}} @endif" name="email" placeholder="email..." value="{{old('email')}}">
                        <span class="glyphicon glyphicon-lock form-control-feedback" aria-hidden="true"></span>
                        @if ($errors->has('email') || session('notregister'))
                        <div class="invalid-feedback" >
                            {{ $errors->first('email') }}
                            {{session('notregister')}}
                        </div>
                        @endif
                    </div>

                    <div class="form-group  ">
                        <input type="text" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" placeholder="password..." value="{{old('password')}}">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                        <div class="invalid-feedback" >
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group  ">
                        <input type="text" class="form-control {{$errors->has('password_confir') ? 'is-invalid' : ''}}" name="password_confir" placeholder="password_confir..." value="{{old('password_confir')}}">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password_confir'))
                        <div class="invalid-feedback" >
                            {{ $errors->first('password_confir') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control  {{$errors->has('firstname') ? 'is-invalid' : ''}}" name="firstname" placeholder="firstname..." value="{{old('firstname')}}">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('firstname'))
                        <div class="invalid-feedback" >
                            {{ $errors->first('firstname') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group  ">
                        <input type="text" class="form-control {{$errors->has('lastname') ? 'is-invalid' : ''}}" name="lastname" placeholder="lastname..." value="{{old('lastname')}}">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('lastname'))
                        <div class="invalid-feedback" >
                            {{ $errors->first('lastname') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
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
    @endsection
