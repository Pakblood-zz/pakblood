@include('header')
@include('search_bar')
<!-- Center Container-->
<div class="row center-container">
    @if(Session::get('message') != NULL)
        @if((Session::has('type')) && (Session::get('type')=='success'))
            <div data-alert class="alert-box success radius  small-20 medium-14 large-20 columns round" style="text-align: center;font-weight: bold;">
                {{ Session::get('message') }}
                <a href="#" class="close">&times;</a>
            </div>
        @endif
        @if((Session::has('type')) && (Session::get('type')=='error'))
            <div data-alert class="alert-box alert radius  small-20 medium-14 large-20 columns round" style="text-align: center;font-weight: bold;">
                {{ Session::get('message') }}
                <a href="#" class="close">&times;</a>
            </div>
        @endif
    @endif
    <table role="grid" style="width: 100%;">
        <tr>
            <th>#</th>
            <th>Name </th>
            <th width="160">Contact Infomation</th>
            <th>Address </th>
            <th width="100">Last Bleed </th>
            <th width="100">Report </th>
        </tr>
        <?php use Carbon\Carbon;$usercount=1; ?>
        @foreach($users as $user)
            <tr>
                <td>{{$usercount}}</td>
                <td>{{$user->name}}</td>
                <td>@if($user->phone != NULL)
                        {!! HTML::image('includes/txt2img.php?txt='.base64_encode($user->phone))!!}
                    @endif
                    @if($user->mobile != NULL)
                        {!! HTML::image('includes/txt2img.php?txt='.base64_encode($user->mobile))!!}
                    @endif
                </td>
                <td>{{$user->address}}</td>
                <?php
                $created = new Carbon($user->last_bleed);
                $now = Carbon::now();
                $difference = ($created->diff($now)->days < 1)
                        ? 'today'
                        : $created->diffForHumans($now);
                ?>
                <td>{{$difference}}</td>
                <td>
                    {{--<a href="{{url('report/user?id='.$user->id)}}" data-reveal-id="myModal" data-reveal-ajax="true">Report Donor</a>--}}
                    <a href="{{url('report/user?id='.$user->id)}}" data-reveal-id="myModal" data-reveal-ajax="true">Report Donor</a>
                    <div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog"></div>
                </td>
            </tr>
            <?php $usercount+=1; ?>
        @endforeach
    </table>
    <?php echo $users->appends(Request::all())->render(); ?>
    <table>
        <tr>
            <th>#</th>
            <th>Organization Name</th>
            <th>Blood Group</th>
            <th>Members </th>
        </tr>
        <?php
        $orgcount = 1;
        if (substr($bg, -1, 1) == 'p') {
            $bg = substr($bg, 0, -1) . '+';
        }
        if (substr($bg, -1, 1) == 'n') {
            $bg = substr($bg, 0, -1) . '-';
        }
        ?>
        @foreach($orgs as $org)
            <tr>
                <td>{{$orgcount}}</td>
                <td><a href="{{url('organization/'.$org->id)}}">{{$org->name}}</a></td>
                <td>{{$bg}}</td>
                <td>{{$org->total_users}}</td>
            </tr>
            <?php $orgcount += 1;?>
        @endforeach
    </table>
</div>
@include('footer')