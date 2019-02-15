@extends('admin.master')
@section('title','Quản lý hóa đơn')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin_theme/plugins/exportdata/buttons.dataTables.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách hóa đơn
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">quanlyhoadon</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary" style="padding: 10px 10px;">
            <div class="row">
                <div class="col-sm-12">
                    <div id="alert-error"></div>
                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="form-group">
                        {{-- <a href="{{route('viewstatust',1)}}">Xem don hang</a> --}}
                        <a href ="{{route('admin.bill.index','status=3')}}" class="btn btn-danger" id="xemdonhang_huy">Xem đơn hàng đã hủy</a>
                        <a href ="{{route('admin.bill.index','status=1')}}"  class="btn btn-primary" id="xemdonhang_vanchuyen">Xem đơn hàng đang vận chuyển</a>
                        <a href ="{{route('admin.bill.index','status=2')}}"  class="btn btn-success" id="xemdonhang_hoanthanh">Đơn đã giao hàng</a>
                    </div>
                    <table id="table_quanlyhoadon" class="table table-striped table-bordered" style="margin: 0;">
                        <thead style="background: #80bfff;text-align: center;">
                            <tr>
                                <th style="vertical-align: middle;text-align: center;">Stt</th>
                                <th style="vertical-align: middle;text-align: center;">{{__('bill.ngaydh')}}</th>
                                <th style="vertical-align: middle;text-align: center;">{{__('bill.tongtien')}}<strong style="color: red;">VNĐ</strong></th>
                                <th style="vertical-align: middle;text-align: center;">{{__('bill.soluong')}}</th>
                                <th style="vertical-align: middle;text-align: center;">{{__('bill.status')}}</th>
                                <th style="vertical-align: middle;text-align: center; width: 100px;">{{__('bill.action')}}</th>
                            </tr>
                        </thead>
                        <tbody id="list_donhang">
                            @foreach($bill as $value)
                            <tr id="row_{{$value->id}}">
                                <?php 
                                $date_tamp=strtotime($value->created_at);
                                $date=date('d/m/Y',$date_tamp); 
                                ?>
                                <td class="text-justify">{{$loop->iteration}}</td>
                                <td class="text-justify">{{$date}}</td>
                                <td class="text-justify">{{number_format($value->total_amount*1000)}}</td>
                                <td class="text-justify">{{$value->total_product}}</td>
                                <td class="text-justify">
                                    @if(Sentinel::getUser()->hasAnyAccess(['admin']))
                                    @if($value->status==0)
                                    <select name="status"  class="form-control status" data-id="{{$value->id}}">
                                        <option value="0" {{($value->status==0)?'selected':''}}>Chưa xử lý</option>
                                        <option value="1" {{($value->status==1)?'selected':''}}>Đang vận chuyển</option>
                                        <option value="3" {{($value->status==3)?'selected':''}}>Đã bị hủy</option>
                                        <option value="2" {{($value->status==2)?'selected':''}}>Đã giao hàng</option>
                                    </select>
                                    @elseif($value->status==1)
                                    <select name="status"  class="form-control status" data-id="{{$value->id}}">
                                        <option value="1" {{($value->status==1)?'selected':''}}>Đang vận chuyển</option>
                                        <option value="3" {{($value->status==3)?'selected':''}}>Đã bị hủy</option>
                                        <option value="2" {{($value->status==2)?'selected':''}}>Đã giao hàng</option>
                                    </select>
                                    @elseif($value->status==3)
                                    <div class="alert-danger">Đã bị hủy</div>
                                    @elseif($value->status==2)
                                    <div class="alert-success">Đã giao hàng</div>
                                    @endif
                                    @else
                                    @if($value->status==0)
                                    <div class="alert-danger">Chưa xử lý</div>
                                    @endif
                                    @if($value->status==1)
                                    <div class="alert-danger">Đang vận chuyển</div>
                                    @endif
                                    @if($value->status==3)
                                    <div class="alert-danger">Đã bị hủy</div>
                                    @endif
                                    @if($value->status==2)
                                    <div class="alert-success">Đã giao hàng</div>
                                    @endif
                                    @endif
                                </td>
                                <td class="text-middle text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-green" data-toggle="dropdown" href="#" aria-expanded="false">
                                            Action<span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">

                                            <li role="presentation" >
                                                <a href="#view_detail" id="update_status_{{$value->id}}"  title="role"  class="text-green"><i class="fa fa-eye text-aqua"></i> Xem</a>
                                            </li>
                                            @if(Sentinel::getUser()->hasAnyAccess(['admin','employee']))
                                            <li role="presentation" class="delete_user">
                                                <a href="javascript:void(0)" title="Xóa" data-toggle="modal" data-target="#delete_modal"  id-del="{{$value->id}}" class="text-red"><i class="fa fa-trash-o"></i> Xóa</a>
                                            </li>
                                            <li role="presentation" >
                                                <a href="{{route('admin.bill.print',$value->id)}}" id="update_print_{{$value->id}}"  title="role"  class="text-blue"><i class="fa fa-print"></i> Print</a>
                                            </li>
                                            @endif

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" id="view_detail" style="display: none;">
                    <div class="col-md-12">
                        <h3 class="text-center">Mã đơn hàng: <span id="id_bill"></span></h3>
                    </div>
                    <div class="col-md-6">
                        <h3>Thông tin khách hàng</h3>
                        <div style="border: 1px solid #cccccc;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="email_cus"></td>
                                        <td id="add_cus"></td>
                                        <td id="phone_cus"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Chi tiết hóa đơn</h3>
                        <div style="border: 1px solid #cccccc;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng đặt</th>
                                        <th>Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody id="dt_product">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="update-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.bill.status')}}" method="post">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Xác nhận thông tin</h4>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title">Trạng thái đơn hàng: <span id="text-status"></span></h4>
                    <input type="hidden" id="id-bill" name="id">
                    <input type="hidden" id="status-change" name="status">
                    <label for="checkmail">
                        <input type="checkbox" name="checkmail" id="checkmail">
                        Gửi mail đến khách hàng?
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa  fa-check"></i> Ok</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $('.status').change(function(event) {
        event.preventDefault();
        $('#id-bill').val($(this).attr('data-id'));
        status= $(this).val();
        if(status==2){
            $('#text-status').html('Đã giao hành thành công');
        }
        if(status==1){
            $('#text-status').html('Đang vận chuyển');
        }
        if(status==3){
            $('#text-status').html('Hủy đơn hàng');
        }
        $('#status-change').val(status);
        $('#update-status').modal('show');

    });
    $('[id^="update_status_"]').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        id=$(this).attr('id').substring(14);
        $.ajax({
            url: '{{route('admin.bill.detail')}}',
            type: 'post',
            data: {id: id},
        })
        .done(function(data) {
            $('#view_detail').slideDown(300);
            $('#email_cus').html(data.bill.user.email);
            $('#add_cus').html(data.bill.address);
            $('#phone_cus').html(data.bill.phone);
            $('#dt_product').html(data.html);
            $('#id_bill').html(id);
        })
        .fail(function(data) {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    });
</script>
<script type="text/javascript" src="{{asset('admin_theme/plugins/exportdata/buttons.html5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin_theme/plugins/exportdata/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin_theme/plugins/exportdata/jszip.min.js')}}"></script>
<script>
    $(document).ready( function() {
        $('#table_quanlyhoadon').DataTable( {
            dom: 'Bfrtip',
            buttons: [ {
                extend: 'excelHtml5',
                customize: function( xlsx ) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="C"]', sheet).attr( 's', '2' );
                }
            } ]
        } );
    } );
</script>
@endsection
