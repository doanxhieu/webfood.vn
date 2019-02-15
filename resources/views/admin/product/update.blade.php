@extends('admin.master')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">quanlysanpham</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="">
                <div class="">
                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Vietnamese</a></li>
                            <li class=""><a href="#en" data-toggle="tab" aria-expanded="false">English</a></li>
                        </ul>
                        
                        @if( session()->has('err'))
                        <div class="alert alert-danger"><strong>Error!</strong>{{session('err')}}!</div>
                        @endif
                        @if(session()->has('success'))
                        <div class="alert alert-success"><strong>Success!</strong>Thêm sản phẩm thành công.</div>
                        @endif
                        <form action="{{route('admin.product.saveinsert')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane active" id="vi">
                                    <div class="box-body">
                                        <div class="form-group col-md-12">
                                            <label for="">Tiêu đề:</label>
                                            <div class="{{ $errors->has('title.vi') ? 'has-error has-danger' : '' }}">
                                                <input type="text" class="form-control" id="title_vi" name="title[vi]" value="{{isset($products_update->translation('vi')->title)?$products_update->translation('vi')->title:old('title.vi')}}" placeholder="Nhập tên sản phẩm...">
                                                @if ($errors->has('title.vi'))
                                                <div class="help-block">
                                                    {{ $errors->first('title.vi')}}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">

                                            <label for="">Mô tả ngắn: </label>
                                            <div class="{{ $errors->has('brief.vi') ? 'has-error has-danger' : '' }}">
                                                <textarea class="form-control" id="brief" name="brief[vi]">{{isset($products_update->translation('vi')->brief)?$products_update->translation('vi')->brief:old('brief.vi')}}</textarea>
                                                @if ($errors->has('brief.vi'))
                                                <div class="help-block" >
                                                    {{ $errors->first('brief.vi') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Mô tả chi tiết: </label>
                                            <div class="{{ $errors->has('description.vi') ? 'has-error has-danger' : '' }}">
                                                @if ($errors->has('description.vi'))
                                                <div class="help-block" >
                                                    {{ $errors->first('description.vi') }}
                                                </div>
                                                @endif
                                                <textarea name="description[vi]" id="description" class="form-control">{{isset($products_update->translation('vi')->description)?$products_update->translation('vi')->description:old('description.vi')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="en">
                                    <div class="box-body">
                                        <div class="form-group col-md-12">
                                            <label for="">Title</label>
                                            <div class="{{ $errors->has('title.en') ? 'has-error has-danger' : '' }}">
                                                <input type="text" class="form-control" id="title_en" name="title[en]" value="{{isset($products_update->translation('en')->title)?$products_update->translation('en')->title:old('title.en')}}" placeholder="Nhập tên sản phẩm...">
                                                @if ($errors->has('title.en'))
                                                <div class="help-block">
                                                    {{ $errors->first('title.en') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Brief</label>
                                            <div class="{{ $errors->has('brief.en') ? 'has-error has-danger' : '' }}">
                                                <textarea class="form-control" id="brief" name="brief[en]">{{isset($products_update->translation('en')->brief)?$products_update->translation('en')->brief:old('brief.en')}}</textarea>
                                                @if ($errors->has('brief.en'))
                                                <div class="help-block" >
                                                    {{ $errors->first('brief.en') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Description</label>
                                            <div class="{{ $errors->has('description.en') ? 'has-error has-danger' : '' }}">
                                                <textarea name="description[en]" id="description" class="form-control description">{{isset($products_update->translation('en')->description)?$products_update->translation('en')->description:old('description.en')}}</textarea>
                                                @if ($errors->has('description.en'))
                                                <div class="help-block" >
                                                    {{ $errors->first('description.en') }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group col-md-12">
                                        <label for="">{{__('product.slug')}}:</label>
                                        <div class="{{$errors->has('slug') ? 'has-error has-danger' : '' }}">
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{isset($products_update->slug)?$products_update->slug:old('slug') }}" placeholder="ten-san-pham-khong-dau..." >
                                            @if ($errors->has('slug'))
                                            <div class="help-block" >
                                                {{ $errors->first('slug') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="">{{__('product.photo')}}:</label>
                                        <div class="{{ $errors->has('file') ? 'has-error has-danger' : '' }}">
                                            <input type="file" class="form-control" id="fileToUpload" name="file[]" multiple>

                                            @if ($errors->has('file'))
                                            <div class="help-block" >
                                                {{ $errors->first('file') }}
                                            </div>
                                            @endif

                                            @if(session()->has('size'))
                                            <div class="help-block" >{{session()->get('size')}}</div>
                                            @elseif(session()->exists('type'))
                                            <div class="help-block" >{{session()->get('type')}}</div>
                                            @endif
                                        </div>
                                        <div id="view_images">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">{{__('product.category_id')}}:</label>
                                        <div class="{{ $errors->has('category_id') ? 'has-error has-danger' : '' }}">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">---Chọn---</option>
                                                {{multiCates_select($cate_value,0, $str='',old('category_id'))}}
                                            </select>

                                            @if ($errors->has('category_id'))
                                            <div class="help-block" >
                                                {{ $errors->first('category_id') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label for="">{{__('product.price')}}:</label>
                                        <div class="{{ $errors->has('price') ? 'has-error has-danger' : '' }}">
                                            <input type="text" class="form-control" id="price" name="price" value="{{isset($products_update->price)?$products_update->price:old('price') }}" placeholder="Đơn giá..." >
                                            @if ($errors->has('price'))
                                            <div class="help-block" >
                                                {{ $errors->first('price') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">{{__('product.quantity')}}:</label>
                                        <div class="{{ $errors->has('quantity') ? 'has-error has-danger' : '' }}">
                                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{isset($products_update->quantity)?$products_update->quantity:old('quantity') }}" placeholder="Đơn giá..." >
                                            @if ($errors->has('quantity'))
                                            <div class="help-block" >
                                                {{ $errors->first('quantity') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('admin.save')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @section('script')
    <script type="text/javascript">
        $(function () {
            CKEDITOR.replace('description[vi]');
            CKEDITOR.replace('description[en]');
        });

    </script>

    <script type="text/javascript" src="{{asset('admin_theme/dist/js/product.js')}}"></script>
    @endsection
    @endsection
