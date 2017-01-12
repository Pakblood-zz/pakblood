@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">{{$user->name}} </h3>
            <div class="bg_icon">
                <li @if($user->gender == ('male')||('Male')) class="fi-torso size-72"
                    @else class="fi-torso-female size-72" @endif></li>
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
            @if (count($errors) > 0)
                <div>
                    @foreach ($errors->all() as $error)
                        <small class="error">{{ $error }}</small>
                    @endforeach
                </div>
            @endif
            <a class="small button" style="border-radius: 50px 5px 5px 50px;" href="{{url('/admin/organization')}}">Go
                Back</a>
            <a class="small button" style="border-radius: 50px 5px 5px 50px;" href="{{url('/admin/users')}}">All
                Users</a>
            <div>
                <a href="{{url('/admin/add/user/'.$user->id.'/bleed')}}" style="position:absolute;"
                   class="button radius">Add User Bleed Details</a>
            </div>
            <table style="margin: auto;">
                <tr>
                    <th>#</th>
                    <th>Receiver Name</th>
                    <th>City</th>
                    <th>Comments</th>
                    <th width="100">Date</th>
                    <th>Edit</th>
                </tr>
                <?php $vcount = $bleed->firstitem();?>
                @foreach($bleed as $bl)
                    <tr>
                        <td>{{$vcount}} </td>
                        <td>{{$bl->receiver_name}}</td>
                        <td>{{$bl->city}}</td>
                        <td>{{$bl->comments}}</td>
                        <td>{{date('d-M-y',strtotime($bl->date))}}</td>
                        <td class="options_btn">
                            <a data-tooltip aria-haspopup="true" class="has-tip" title="Edit"
                               href="{{url('/admin/user/'.$user->id.'/edit/bleed/'.$bl->id)}}">
                                <li class="fi-page-edit size-25"></li>
                            </a>
                        </td>
                    </tr>
                    <?php $vcount += 1;?>
                @endforeach
            </table>
            <?php echo $bleed->render(); ?>
        </div>
    </div>
</section>

@include('admin.footer')