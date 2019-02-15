@extends('admin.master')
@section('title','Quản lý sản phẩm')
@section('content')
@section('css')
<style type="text/css">
.content .table .text-justify{
    vertical-align: middle;
    text-align: center;
}
.table .pointer a{
    cursor: pointer;
}
</style>
@endsection
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">quanlysanpham</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary" style="padding: 10px 10px;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert-error"></div>
                    <table id="table_product" class="table table-striped table-bordered table-hover" style="margin: 0;">
                        <thead style="background: #80bfff;">
                            <tr>
                                <th class="text-center">STT</th>
                                <th width="text-center">{{__('product.title')}}</th>
                                <th width="text-center">{{__('product.photo')}}</th>
                                <th  class="text-center">{{__('product.description')}}</th>
                                <th width="text-center">{{__('product.price')}}</th>
                                <th width="text-center">{{__('product.quantity')}}</th>
                                <th width="text-center">Người tạo</th>
                                <th width="text-center">{{__('product.created_at')}}</th>
                                <th  class="text-center">{{__('admin.update')}}</th>
                                <th  class="text-center">{{__('admin.delete')}}</th>
                            </tr>
                        </thead>
                        <tbody id="list_sanpham">
                            @foreach($product_t as $value)
                            <tr id="row_product_{{$value->id}}">
                                <?php 
                                $date_tamp=strtotime($value->created_at);
                                $date=date('d/m/Y',$date_tamp); 
                                $img = $value->photo;
                                $image = explode('__',$img);
                                ?>
                                <td class="text-justify">{{$loop->iteration}}</td>
                                <td  class="text-justify" id="title_{{$value->id}}">{{$value->title}}</td>
                                <td  class="text-justify" id="img_{{$value->id}}"><img src="{{asset('upload/products')}}/{{$image[0]}}" alt="" width="100px"></td>
                                <td  id="des_{{$value->id}}" style="vertical-align: middle; text-align: justify;">
                                    {{ str_limit(strip_tags($value->description), 100) }}
                                    @if (strlen(strip_tags($value->description)) > 100)
                                    ... <a href="javascript:void(0)" id="readmore_{{$value->id}}" data-id="{{$value->id}}">Read More</a>
                                    @endif
                                </td>
                                <td  class="text-justify text-" id="price_{{$value->id}}">{{$value->price}}</td>
                                <td  class="text-justify" id="qty_{{$value->id}}">{{$value->quantity}}</td>
                                <td  class="text-justify" id="user_{{$value->id}}">
                                    {{(isset($user_p->email)?$user_p->email :'')}}
                                </td>
                                <td  class="text-justify">{{$date}}</td>
                                <td id="col_update_sp" class="text-justify">
                                    <a href="{{route('admin.product.update',$value->slug)}}" title="Sửa" id-update="{{$value->id}}"><i class="fa fa-edit text-blue"></i></a>
                                </td>
                                <td id="col_delete_sp" class="text-justify pointer">
                                    <a data-toggle="modal" data-target="#delete_product" title="Xóa" id="delete_product_{{$value->id}}"><i class="fa fa-trash-o text-red"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal DELETE -->
<div class="modal fade" id="delete_product" role="dialog">
    <div class="modal-dialog modal-sm" style="top:130px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Bạn có chắc chắc muốn xóa trường này?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="product_id_del" name="del_id_product">
                <input type="hidden" id="product_name_del" name="product_name_del">
                <button type="button" class="btn btn-danger" id="btn-delete-product"><i class="fa fa-trash"></i> Delete</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal thong bao -->
<div class="modal fade" id="thongbao" role="dialog">
    <div class="modal-dialog modal-sm" style="top:130px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="body-thongbao">
                <img src="{{asset('admin_theme/dist/img/success.gif')}}" style="width: 100px;">
            </div>
        </div>
    </div>
</div>
@section('script')
<script type="text/javascript" src="{{asset('admin_theme/dist/js/product.js')}}"></script>
@endsection
@endsection
