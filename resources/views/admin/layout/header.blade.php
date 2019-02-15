<header class="main-header">
    <a href="{{route('admin.index')}}" class="logo">
        <span class="logo-mini"><b>A</b>LT</span>
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href=" #" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if(Sentinel::check())
                @if(Sentinel::getUser())
                <li class="dropdown user user-menu">
                    <a href=" #" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('admin_theme/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Sentinel::getUser()->email}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{asset('admin_theme/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                            <p>
                                {{Sentinel::getUser()->email}}
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href=" #">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href=" #">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href=" #">Friends</a>
                                </div>
                            </div>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('admin.profile.view')}}?id={{Sentinel::getUser()->id}}" class="btn btn-success btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('admin.logout')}}" class="btn btn-danger btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
                @endif
                <li>
                    <a href=" #" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                <!-- Control LANGUAGE Toggle Button -->
                <li style="padding-top: 15px;margin-right: 15px;">
                    <button type="button" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Languages <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="?lang=vi"><img class="flag" height="16px" src="{{asset('svg/vi.svg')}}" alt="Vietnam Flag"> Vietnamese</a></li>
                        <li><a href="?lang=en"><img class="flag" height="16px" src="{{asset('svg/en.svg')}}" alt="United Kingdom Flag"> English</a></li>
                    </ul>
                </li>
                <li id='lang'>
                    @if(app()->getLocale())
                    <a href="?lang=vi"><img class="flag" height="16px" src="{{asset('svg/'.app()->getLocale().'.svg')}}" alt="{{app()->getLocale()}}"></a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
</header>

