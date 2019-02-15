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
            <div class="col-md-12 col-xs-12">
                @if(session()->has('not_role'))
                <div class="alert alert-danger">{{session('not_role')}}</div>
                @endif
                @if(session()->has('success_role'))
                <div class="alert alert-success">{{session('success_role')}}</div>
                @endif
                @if(session()->has('not_success_role'))
                <div class="alert alert-danger">{{session('not_success_role')}}</div>
                @endif
                <div class="form-group">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_add_role" id='btn-addrole'><i class="fa fa-plus text-white"></i> Thêm quyền hệ thống</button>
                </div>
                <table id="table_role" class="table table-striped table-bordered table-hover" style="margin: 0;">
                    <thead style="background: #80bfff;">
                        <tr>
                            <th  class="text-center">STT</th>
                            <th class="text-center">{{__('admin.name')}}</th>
                            <th  class="text-center">{{__('admin.created_at')}}</th>
                            <th  class="text-center">{{__('admin.action')}}</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_role">
                        @foreach($role as $value)
                        <tr id="row_{{$value->id}}">
                            @php
                            $arr_per = ($value->getPermissionsAttribute(json_encode($value->permissions)));
                            $date_tamp=strtotime($value->created_at);
                            $date=date('d/m/Y',$date_tamp); 
                            @endphp
                            <td class="text-middle text-justify">{{$loop->iteration}}</td>
                            <td  class="text-middle text-justify" id="name_{{$value->id}}">{{$value->name}}</td>

                            <td  class="text-justify">{{$date}}</td>
                            <td class="text-justify">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-green" data-toggle="dropdown" href="#" aria-expanded="false">
                                        Action<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @if($value->slug != 'user')
                                        <li role="presentation"><a href="javascript:" title="View" data-toggle="modal" data-target="#set_permissions_{{$value->id}}" class="text-aqua"><i class="fa fa-gears"></i>Changes Permissions</a></li>
                                        @endif
                                        <li role="presentation"><a href="javascript:" data-toggle="modal"
                                         data-target="#delete_modal" onclick="del('this','{{route('admin.role.delete')}}','{{$value->id}}','btn-delete')" title="Xóa" id-del="{{$value->id}}" class="text-red"><i class="fa fa-trash-o"></i> Delete</a></li>
                                     </ul>
                                 </div>
                             </td>
                         </tr>
                         {{-- MODAL --}}
                         <div class="modal fade" id="set_permissions_{{$value->id}}">
                            <div class="modal-dialog modal-lg">
                                <form action="{{route('admin.role.update','id='.$value->id)}}" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="modal-tile-role">Đặc quyền</h4>
                                        </div>
                                        <div class="modal-body row">
                                            <div class="form-group ">
                                                <label class="col-md-2">Name role:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="name" placeholder="Enter name role..." value="{{$value->name}}" disabled>
                                                </div>

                                            </div>
                                            @csrf
                                            @php
                                            $permissions = $value->permissions;
                                            @endphp
                                            @foreach(config('app.role_permission') as $key => $v)
                                            <div class="form-group col-md-4" id="{{$key}}">
                                                <span style="font-weight: 600;">
                                                    @php
                                                    switch ($key) {
                                                        case 'user':
                                                        echo __('admin.manageruser');
                                                        break;
                                                        case 'product':
                                                        echo __('admin.managerproduct');
                                                        break;
                                                        case 'bill':
                                                        echo __('admin.managerbill');
                                                        break;
                                                        case 'category':
                                                        echo __('admin.manager_catagory');
                                                        break;
                                                        case 'role':
                                                        echo 'Role';
                                                        break;
                                                        case 'profile':
                                                        echo 'Profile';
                                                        break;
                                                    }
                                                    @endphp
                                                </span>
                                                @foreach($v as $k => $val)
                                                <div class="checkbox">
                                                    <label for="{{$key}}_{{$k}}_{{$value->id}}">
                                                        <input type="checkbox" id ="{{$key}}_{{$k}}_{{$value->id}}"
                                                        name="{{$key}}[{{$k}}]" {{(old($key.'.'.$k))?'checked':''}}
                                                        {{($permissions[$key.'.'.$k]==true)?'checked':''}}
                                                        >  {{$k}}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save change</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- INSERT ROLE --}}
<div class="modal fade" id="modal_add_role">
    <div class="modal-dialog modal-lg">
        <form action="{{route('admin.role.create')}}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modal-tile-role">Thêm quyền</h4>
                </div>
                <div class="modal-body row">
                    @csrf
                    <div class="form-group ">
                        <label class="col-md-2">Name role:</label>
                        <div class="{{$errors->has('name')?'has-error has-danger':''}} col-md-10">
                            <input type="text" class="form-control" name="name" id="namerole" placeholder="Enter name role..." value="{{old('name')}}">
                        </div>
                        <span class="help-block text-red" id="error_role">{{ $errors->first('name') }}</span>

                    </div>
                    <h3 class="col-md-12" style="font-size: 18px; font-weight: 600;">SET PERMISSIONS</h3>
                    @foreach(config('app.role_permission') as $key => $value)

                    <div class="form-group col-md-4">
                        <span style="font-weight: 600;">
                            @php
                            switch ($key) {
                                case 'user':
                                echo __('admin.manageruser');
                                break;
                                case 'product':
                                echo __('admin.managerproduct');
                                break;
                                case 'bill':
                                echo __('admin.managerbill');
                                break;
                                case 'category':
                                echo __('admin.manager_catagory');
                                break;
                                case 'role':
                                echo 'Role';
                                break;
                            }
                            @endphp
                        </span>
                        @foreach($value as $k => $val)
                        <div class="checkbox">
                            <label for="{{$key}}.{{$k}}">
                                <input type="checkbox" class="minimal-red" name="{{$key}}[{{$k}}]" {{(old($key.'.'.$k)) ? 'checked':''}}>  {{$k}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
