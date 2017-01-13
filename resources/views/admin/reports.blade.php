@include('admin.head')
@include('admin.side_bar')
<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">Reports </h3>
            <div class="bg_icon">
                <li class="fi-page-multiple size-72"></li>
            </div>
        </div>
        <div class="row">
            @if(Session::get('message') != NULL)
                @if((Session::has('type')) && (Session::get('type')=='success'))
                    <div data-alert class="alert-box success radius  small-20 medium-14 large-20 columns round"
                         style="text-align: center;font-weight: bold;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
                @if((Session::has('type')) && (Session::get('type')=='error'))
                    <div data-alert class="alert-box alert radius  small-20 medium-14 large-20 columns round"
                         style="text-align: center;font-weight: bold;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
            @endif
            <table role="grid" style="width: 100%;">
                <tr>
                    <th>#</th>
                    <th>Reported User</th>
                    <th>Details</th>
                    <th>Options</th>
                </tr>
                <?php $count = 1; ?>
                @foreach($users as $user)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$user->name}}</td>
                        <td>
                            <table style="width: 100%;">
                                <tr>
                                    {{--<th># </th>--}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Reason</th>
                                    <th>Delete</th>
                                </tr>
                                <?php $rcount = 1; ?>
                                @foreach($reports as $report)
                                    @foreach($report as $r)
                                        @if($r->reported_user_id == $user->user_id)
                                            <tr>
                                                {{--<td>{{$rcount}} </td>--}}
                                                <td>{{$r->reporter_name}} </td>
                                                <td>{{$r->reporter_email}} </td>
                                                <td>{{$r->reporter_message}} </td>
                                                <td>{{$r->type}} </td>
                                                <td class="options_btn">
                                                    <a data-tooltip aria-haspopup="true" class="tip-left" title="Delete"
                                                       href="{{url('/admin/delete/report/'.$r->id)}}">
                                                        <li class="fi-trash size-25"></li>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $rcount += 1; ?>
                                        @endif
                                    @endforeach
                                @endforeach
                            </table>
                        </td>
                        <td class="options_btn">
                            <a data-tooltip aria-haspopup="true" class="tip-left" title="View"
                               href="{{url('/admin/user/'.$user->id)}}">
                                <li class="fi-eye size-25"></li>
                            </a>
                            <a data-tooltip aria-haspopup="true" class="tip-left" title="Block"
                               href="{{url('/admin/delete/reported/user/'.$user->id)}}">
                                <li class="fi-trash size-25"></li>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</section>

@include('admin.footer')