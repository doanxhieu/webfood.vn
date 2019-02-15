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
                <div class="col-md-12">
                    <div class="alert-error">
                        @if(session()->has('success'))
                        <div class="alert alert-success">{{session()->get('success')}}</div>
                        @endif
                        @if($errors->has('err_del_exception'))
                        <div class="alert alert-success">{{$errors->first('err_del_exception')}}</div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <a href="{{route('admin.category.insert')}}" class="btn btn-primary"><i class="fa fa-plus text-white"></i> Thêm danh mục</a>
                    </div>
                    <table id="table_danhmuc" class="table table-striped table-bordered table-hover" style="margin: 0;">
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
                            @foreach($cate_trans as $value)
                            <tr id="row_{{$value->id}}">
                                <?php 
                                $date_tamp=strtotime($value->created_at);
                                $date=date('d/m/Y',$date_tamp); 
                                ?>
                                <td class="text-justify">{{$loop->iteration}}</td>
                                <td  class="text-justify" id="name_{{$value->id}}" >{{$value->name}}</td>
                                <td  class="text-justify" id="slug_{{$value->id}}">{{$value->slug}}</td>
                                <td  class="text-center">{{$date}}</td>
                                <td  class="text-center col_update_cate">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#update_cate" title="Sửa"  id-update="{{$value->id}}" data-parentid="{{$value->parent_id}}"><i class="fa fa-edit text-blue"></i></a>
                                </td>
                                <td  class="text-center col_delete_sp">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#delete_modal" title="Xóa" onclick="del('this','{{route('admin.category.delete')}}','{{$value->id}}','btn-delete')" id-del="{{$value->id}}"><i class="fa fa-trash-o text-red"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
  
    <!-- Modal UPDATE -->
    <div class="modal fade" id="update_cate" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông tin danh mục</h4>
                </div>
                <div id="err_update_cate"></div>
                <form role="form" id="frmUpdate_Cate" method="post">
                    @csrf
                    <input type="hidden" id="id_update">
                    <div class="modal-body">
                        <div><h3>{{__('category.title_update')}}</h3></div>
                        <div class="form-group">
                            <label for="name_update">{{__('category.name')}} (<span style="color: red;">*</span>) </label>
                            <input type="text" class="form-control" id="name_update" name="name_update" required>
                        </div>
                        <div class="form-group">
                            <label>{{__('category.parent')}}</label>
                            <select name="parent_id" id="parent_cate_update">
                                <option value="0">---Chọn---
                                </option>
                                {{multiCates_select($cate_trans)}}
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="btn_update_cate"><i class="fa fa-upload"></i> Update</button>
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
<script type="text/javascript" src="{{asset('admin_theme/dist/js/category.js')}}"></script>
@endsection
@endsection
