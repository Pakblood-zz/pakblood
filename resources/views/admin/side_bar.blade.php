<div class="off-canvas-wrap offcanvas-overlap" data-offcanvas>

    <div class="inner-wrap">
        <nav class="tab-bar">
            <section id="menu_icon" class="left-small">
                <a class="left-off-canvas-toggle menu-icon"><span></span></a>
            </section>
            <section class="right">
                <div id="admin_nav" class="right">
                    <a data-dropdown="drop" aria-controls="drop" aria-expanded="false">{{ \Auth::user()->name }}</a>
                    <ul id="drop" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
                        {{--<li><a href="#">My Profile</a></li>--}}
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                </div>
            </section>
        </nav>
        <div class="left-off-canvas-menu sidebar" style="position: fixed;">
            <ul class="off-canvas-list">
                <div class="sidebar_wrapper" id="">
                    <div class="user_info">
                        <img src="http://www.gravatar.com/avatar/5fa9da59a9fdbfc3a08c75d8acc7d698?d=mm&s=128">
                        {{-- <a href="https://www.gravatar.com">
                             <span> change</span>
                         </a>--}}
                    </div>
                    <a class="visit_site" href="{{ url('/') }}" target="_blank">Visit Site </a>
                    <ul class="side_nav">
                        <li class=@if(\Request::is('admin') || \Request::is('admin/dashboard')) "active" @endif>
                            <a href="{{url('/admin/dashboard')}}"><i class="fi-graph-trend"></i> Dashboard </a>
                        </li>
                        <li class=@if(\Request::is('admin/user') || \Request::is('admin/user/*')) "active" @endif>
                            <a href="{{url('/admin/user')}}" class=""><i class="fa fa-edit fa-fw"></i> Users </a>
                        </li>
                        <li class=@if(\Request::is('admin/deleted/user') || \Request::is('admin/deleted/user/*')) "active" @endif>
                            <a href="{{url('/admin/deleted/user')}}" class=""><i class="fa fa-edit fa-fw"></i> Deleted
                                Users </a>
                        </li>
                        <li class=@if(\Request::is('admin/organization') || \Request::is('admin/organization/*')) "active" @endif>
                            <a href="{{url('/admin/organization')}}" class=""><i class="fa fa-edit fa-fw"></i>
                                Organizations </a>
                        </li>
                        <li class=@if(\Request::is('admin/reports') || \Request::is('admin/reports/*')) "active" @endif>
                            <a href="{{url('/admin/reports')}}" class=""><i class="fa fa-edit fa-fw"></i> User Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </ul>
        </div>

{{--
<div class="sidebar" role="navigation">
    <div class="sidebar_wrapper" id="">
        <div class="user_info"><img src="http://www.gravatar.com/avatar/5fa9da59a9fdbfc3a08c75d8acc7d698?d=mm&s=128" ><a href="https://www.gravatar.com"><span> change</span></a></div>
        <a class="visit_site" href="#">Visit Site  </a>
        <ul class="side_nav">
            <li class="active">
                <a  href="#" ><i class="fi-dashboard"></i> Dashboard</a>
            </li>
            <li class="">
                <a  href="#" class=""><i class="fa fa-edit fa-fw"></i> Blog  </a>
                <span class="badge pull-right">4</span>
                <div class="items-bar">
                    <a href="#" class="ic-plus" title="Add" ></a>
                    <a  title="List" class="ic-lines" href="#" >  </a>
                </div>
            </li>
            <li class="">
                <a  href="http://demo.serverfire.net/panel/Page/all" class=""><i class="fa fa-edit fa-fw"></i> Pages  </a>   <span class="badge pull-right">8</span> <div class="items-bar"> <a href="http://demo.serverfire.net/panel/Page/edit" class="ic-plus" title="Add" ></a> <a  title="List" class="ic-lines" href="http://demo.serverfire.net/panel/Page/all" >  </a>  </div>
            </li>
            <li class="">
                <a  href="http://demo.serverfire.net/panel/Project/all" class=""><i class="fa fa-edit fa-fw"></i> Projects  </a>   <span class="badge pull-right">2</span> <div class="items-bar"> <a href="http://demo.serverfire.net/panel/Project/edit" class="ic-plus" title="Add" ></a> <a  title="List" class="ic-lines" href="http://demo.serverfire.net/panel/Project/all" >  </a>  </div>
            </li>
        </ul>
    </div>
</div>--}}
