@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">404 error</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            @if($errors->has('not_permissions'))
            <h2 class="headline text-yellow"><img src="{{asset('admin_theme/dist/img/warning-error.png')}}" alt="" width="100px;"></h2>
            @else
            <h2 class="headline text-yellow">404</h2>
            @endif
            <div class="error-content">
                
                @if($errors->has('not_permissions'))
                <h3><i class="fa fa-warning text-yellow"></i><strong class="text-red">{{$errors->first('not_permissions')}}</strong></h3>
                    <p>
                    Bạn có thể quay lại<a href="{{route('admin.index')}}" class="text-blue">trang chủ</a> hoặc thử sử dụng biểu mẫu tìm kiếm.
                </p>
                @else
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                <p>
                    Chúng tôi không thể tìm thấy trang bạn đang tìm kiếm. Trong khi đó, bạn có thể quay lại
                    <a href="{{route('admin.index')}}" class="text-blue">trang chủ</a> hoặc thử sử dụng biểu mẫu tìm kiếm.
                </p>
                @endif
                

                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
