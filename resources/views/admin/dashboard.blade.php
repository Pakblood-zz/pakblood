@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">Dashboard </h3>
            <div class="bg_icon">
                <li class="fi-graph-trend size-72"></li>
            </div>
        </div>
        <div class="row">
            <div class="small-7 columns left panel_div">
                <div class="panel panel_blue">
                    <div class="panel_heading">
                        <div class="row">
                            <div class="small-20 columns">Users</div>
                        </div>
                        <div class="row" style="font-size: 14px">
                            <div class="small-10 columns">
                                <span>Active: </span><span>{{ $activeUser }}</span>
                            </div>
                            <div class="small-10 columns">
                                <span>Inactive: </span><span>{{ $inactiveUser }}</span>
                            </div>
                            <div class="small-10 columns left">
                                <span>Reported: </span><span>{{ $reportedUser }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel_footer">
                        <a href="{{url('/admin/user')}}" class="">Show List
                            <li class="fi-arrow-right size-12"></li>
                        </a>
                        <div class="right add panel_blue"><a>Add </a></div>
                    </div>
                </div>
            </div>
            <div class="small-7 columns left panel_div">
                <div class="panel panel_green">
                    <div class="panel_heading">
                        <div class="row">
                            <div class="small-20 columns">Organizations</div>
                        </div>
                        <div class="row" style="font-size: 14px">
                            <div class="small-10 columns">
                                <span>Active: </span><span>{{ $activeOrg }}</span>
                            </div>
                            <div class="small-10 columns">
                                <span>Inactive: </span><span>{{ $inactiveOrg }}</span>
                            </div>
                            <div class="small-10 columns">
                                <span>&thinsp;</span><span></span>
                            </div>
                        </div>
                    </div>
                    <div class="panel_footer">
                        <a href="{{url('/admin/organization')}}" class="">Show List
                            <li class="fi-arrow-right size-12"></li>
                        </a>
                        <div class="right add panel_green"><a>Add </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.footer')