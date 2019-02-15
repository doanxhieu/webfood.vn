@extends('admin.master')
@section('title','Setting')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{__('category.title')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">setting</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary" style="padding: 10px 10px;">
            <div class="row">
                <div class="col-md-6">
                    <h3>Thêm menu</h3>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Vietnamese</a>
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
                        action="{{route('admin.setting.savemenu')}}"
                        method="post">
                        <div class="tab-content">
                            @csrf
                            <div class="tab-pane active" id="tab_1">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name(vi) (<span
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
                                        <label for="exampleInputEmail1">Name(en)
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

                            </div>
                            <!-- /.tab-pane -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Lưu
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- /.tab-content -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert-error">
                    @if(session()->has('success'))
                    <div class="alert alert-success">{{session()->get('success')}}</div>
                    @endif
                    @if($errors->has('err_del_exception'))
                    <div class="alert alert-success">{{$errors->first('err_del_exception')}}</div>
                    @endif
                </div>
                <table class="table table-striped table-bordered table-hover" style="margin: 0;">
                    <thead style="background: #80bfff;">
                        <tr>
                            <th  class="text-center">STT</th>
                            <th width="text-center">{{__('category.title')}}</th>
                            <th  class="text-center">{{__('category.slug')}}</th>
                            <th  class="text-center">{{__('admin.created_at')}}</th>
                            <th  class="text-center">{{__('admin.update')}}</th>
                            <th  class="text-center">{{__('admin.delete')}}</th>
                        </tr>
                    </thead>
                    <tbody id="list_danhmuc">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal UPDATE -->
<div class="modal fade" id="update_menu" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="err_update_cate"></div>
            <form role="form" id="frmUpdate_menu" method="post">
                @csrf
                <input type="hidden" id="id_update">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name_update">Name (<span style="color: red;">*</span>) </label>
                        <input type="text" class="form-control" id="name_update" name="name_update" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="btn_update_menu"><i class="fa fa-upload"></i> Update</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" ><i class="fa fa-remove"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END.Modal UPDATE -->
</div>
@section('script')
<script type="text/javascript" src="{{asset('js/sweetalert.min.js')}}"></script>
@endsection
@endsection
