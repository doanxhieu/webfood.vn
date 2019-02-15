@extends('admin.master')
@section('title','Quản lý danh mục sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{__('category.title')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">quanlyloaisanpham</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary" style="padding: 10px 10px;">
            <div class="row">
                <div class="col-md-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1"
                              data-toggle="tab"
                              aria-expanded="true">Vietnamese</a>
                          </li>
                          <li class=""><a href="#tab_2" data-toggle="tab"
                            aria-expanded="false">English</a>
                        </li>
                    </ul>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong>Xảy ra lỗi nhập dữ
                        liệu!
                    </div>
                    @endif
                    <form role="form"
                    action="{{route('admin.category.save')}}"
                    method="post">
                    <div class="tab-content">
                        @csrf
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name(<span
                                        class="text-red">*</span>
                                    </label>)
                                    <div class="{{$errors->has('name.vi')?'has-error':''}}">
                                        <input type="text"
                                        class="form-control"
                                        id="exampleInputEmail1"
                                        name="name[vi]"
                                        placeholder="Tên danh mục"
                                        value="{{old('name.vi')}}">
                                        @if($errors->has('name.vi'))
                                        <span class="help-block">{{$errors->first('name.vi')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title
                                        (<span class="text-red">*</span>
                                    </label>)
                                    <div class="{{$errors->has('name.en')?'has-error':''}}">
                                        <input type="text"
                                        class="form-control"
                                        id="exampleInputEmail1"
                                        name="name[en]"
                                        placeholder="Tên danh mục"
                                        value="{{old('name.en')}}">
                                        @if($errors->has('name.en'))
                                        <span class="help-block">{{$errors->first('name.en')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="slug">{{__('category.slug')}}</label>
                                <div class="{{$errors->has('slug')?'has-error':''}}">
                                    <input type="text"
                                    class="form-control"
                                    id="slug" name="slug"
                                    placeholder="ten-khong-dau"
                                    value="{{old('slug')}}">
                                    @if($errors->has('slug'))
                                    <span class="help-block">{{$errors->first('slug')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('category.parent')}}</label>
                                <select name="parent_id">
                                    <option value="0">---Chọn---
                                    </option>
                                {{multiCates_select($cate_trans)}}
                                </select>
                        </div>

                    </div>
                    <!-- /.tab-pane -->

                    <div class="box-footer">
                        <button type="submit"
                        class="btn btn-primary"><i
                        class="fa fa-save"></i>Lưu
                    </button>
                </div>
            </div>
        </form>
        <!-- /.tab-content -->
    </div>
</div>
<div class="col-md-4">
    @if(session()->has('notsuccess'))
    <div class="alert alert-danger">{{session()->get('notsuccess')}}</div>
    @endif

</div>
</div>
</div>
</section>
</div>

@endsection
