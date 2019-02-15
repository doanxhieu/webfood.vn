<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('admin_theme/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            @if(Sentinel::check())
            @if(Sentinel::getUser())
            <div class="pull-left info">
                <p>{{Sentinel::getUser()->email}}</p>
                <a href=" #"><i class="fa fa-circle text-success"></i> Online</a>
                <a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i> Đăng xuất</a>
            </div>
            @endif
            @endif
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            
            
            <li class="{{Route::is('admin.user.*')?'active':''}}">
                <a href="{{route('admin.user.view')}}">
                    <i class="fa fa-users"></i> <span>{{__('admin.manageruser')}}</span>
                </a>
            </li>
            <li class="{{Route::is('admin.role.*')?'active':''}}">
                <a href="{{route('admin.role.view')}}">
                    <i class="fa fa-files-o"></i> <span>{{__('admin.role')}}</span>
                </a>
            </li>

            <li class="{{Route::is('admin.category.view')?'active':''}}">
                <a href="{{route('admin.category.view')}}">
                    <i class="fa fa-files-o"></i> <span>{{__('admin.manager_catagory')}}</span>
                </a>
            </li>

            <li class="{{Route::is('admin.bill.*')?'active':''}}">
                <a href="{{route('admin.bill.index','status=0')}}">
                    <i class="fa fa-files-o"></i> <span>{{__('admin.managerbill')}}</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">{{$count_bill}}</small>
                    </span>
                </a>
            </li>

            <li class="treeview {{(Route::is('admin.product.*')) ? 'active menu-open':''}}">
                <a href=" #">
                    <i class="fa fa-barcode"></i> <span>{{__('admin.managerproduct')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Route::is('admin.product.index')? 'active' :''}}"><a href="{{route('admin.product.index')}}"><i class="fa fa-circle-o"></i>Danh sách</a></li>
                    <li class="{{Route::is('admin.product.insert')? 'active' :''}}"><a href="{{route('admin.product.insert')}}"><i class="fa fa-circle-o"></i>Thêm sản phẩm</a></li>
                </ul>
            </li>

            <li class="treeview {{(Route::is('admin.setting.*')) ? 'active menu-open':''}}">
                <a href=" #">
                    <i class="fa fa-gears"></i> <span>Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Route::is('admin.setting.menu')? 'active' :''}}"><a href="{{route('admin.setting.menu')}}"><i class="fa fa-circle-o"></i>Menu</a></li>
                    <li class="{{Route::is('admin.product.insert')? 'active' :''}}"><a href="{{route('admin.product.insert')}}"><i class="fa fa-circle-o"></i>Infomations</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
