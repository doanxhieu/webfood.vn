@extends('admin.user.home')
@section('homeuser')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách người dùng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">quanlynguoidung</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary" style="padding: 10px 10px;">
            <div class="row">
                <form method="POST" action="admin/patch">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                        @method('put')

                </form>


                <div class="col-md-12 col-xs-12">
                    @if(session()->has('not_role'))
                        <div class="alert alert-danger">{{session('not_role')}}</div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="form-group">
                        <a href="{{route('admin.user.create')}}" class="btn  btn-primary"><i
                                    class="fa fa-plus text-white"></i> Thêm người dùng</a>
                    </div>
                    <table id="table_admin" class="table table-striped table-bordered table-hover" style="margin: 0;">
                        <thead style="background: #80bfff;">
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">{{__('admin.email')}}</th>
                            <th class="text-center">{{__('admin.role')}}</th>
                            <th class="text-center">{{__('admin.created_at')}}</th>
                            <th class="text-center">{{__('admin.action')}}</th>
                        </tr>
                        </thead>
                        <tbody id="list_sanpham">
                        @foreach($users as $value)
                            <tr id="row_{{$value->id}}">
                                <?php
                                $date_tamp = strtotime($value->created_at);
                                $date = date('d/m/Y', $date_tamp);
                                ?>
                                <td class="text-middle text-center">{{$loop->iteration}}</td>
                                <td class="text-middle text-center" id="email_{{$value->id}}">{{$value->email}}</td>
                                <td class="text-middle text-center" id="role_{{$value->id}}">
                                    @if($value->roles()->first()==null)
                                        Chưa cấp quyền
                                    @else
                                    {{($value->roles()->first()->name)}}
                                    @endif
                                </td>
                                <td class="text-middle text-center">{{$date}}</td>
                                <td class="text-middle text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-green" data-toggle="dropdown" href="#"
                                           aria-expanded="false">
                                            Action<span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if(Sentinel::getUser()->email === $value->email)
                                                <li role="presentation">
                                                    <a href="{{route('admin.profile.view')}}?id={{$value->id}}"
                                                       title="View" class="text-aqua"><i
                                                                class="fa fa-eye text-aqua"></i> Xem</a>
                                                </li>
                                            @endif
                                            @if(Sentinel::getUser()->hasAnyAccess(['admin']))
                                                <li role="presentation" class="delete_user">
                                                    <a href="javascript:void(0)" title="Xóa" data-toggle="modal"
                                                       data-target="#delete_modal"
                                                       onclick="del('this','{{route('admin.user.delete')}}','{{$value->id}}','btn-delete')"
                                                       id-del="{{$value->id}}" class="text-red"><i
                                                                class="fa fa-trash-o"></i> Xóa</a>
                                                </li>
                                                
                                                <li role="presentation">
                                                    <a href="javascript:" id="update_role_{{$value->id}}" title="role"
                                                       class="text-green"><i class="fa fa-gears"></i> Cài đặt quyền</a>
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
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myUpdateRole" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Role</h4>
                    </div>
                    <form action="{{route('admin.user.changerole')}}" method="post">
                        @csrf
                        <div class="modal-body row">
                            <input type="hidden" class="form-control" id="id_change_pers" name="id">
                            <input type="hidden" id="name_role" name="role_hist">
                            <div class="form-group col-md-12">
                                <div class="col-md-2">Email</div>
                                <div class="col-md-10">
                                    <input type="text" value="" id="email_role" class="form-control"
                                           disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="col-md-2">Quyền</div>
                                <div class="col-md-10">
                                    <select name="permissions" id="role_user" class="form-control">
                                        <option value="">---Chọn quyền---</option>
                                        @foreach($role as $value)
                                            <option value="{{$value->slug}}"
                                                    id="value_{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save change
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                        class="fa fa-close"></i> Close
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <script>

    </script>
@endsection
