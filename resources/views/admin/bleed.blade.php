@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">{{$user->name}} </h3><div class="bg_icon"><li @if($user->gender == ('male')||('Male')) class="fi-torso size-72" @else class="fi-torso-female size-72" @endif></li></div></div>
        <div class="row">
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
            @if (count($errors) > 0)
                <div>
                    @foreach ($errors->all() as $error)
                        <small class="error">{{ $error }}</small>
                    @endforeach
                </div>
            @endif
            <a class="small button" style="border-radius: 50px 5px 5px 50px;" href="{{url('/admin/organization')}}">Go Back</a>
            <a class="small button" style="border-radius: 50px 5px 5px 50px;" href="{{url('/admin/users')}}">All Users</a>
            @if(isset($type) && $type == 'view')
                <div>
                    <a href="{{url('/admin/add/user/'.$user->id.'/bleed')}}" style="position:absolute;" class="button radius">Add User Bleed Details</a>
                </div>
                <table style="margin: auto;">
                    <tr>
                        <th># </th>
                        <th>Receiver Name </th>
                        <th>City </th>
                        <th>Comments </th>
                        <th width="100">Date </th>
                        <th>Edit </th>
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
                                <a data-tooltip aria-haspopup="true" class="has-tip" title="Edit" href="{{url('/admin/user/'.$user->id.'/edit/bleed/'.$bl->id)}}"><li class="fi-page-edit size-25"></li> </a>
                            </td>
                        </tr>
                        <?php $vcount += 1;?>
                    @endforeach
                </table>
                <?php echo $bleed->render(); ?>
            @endif
            @if(isset($type) && $type == 'edit')
                {!! Form::open(array('url' => '/admin/user/edit/bleed')) !!}
                {!! Form::hidden('bleed_id', $bleed->id) !!}
                {!! Form::hidden('user_id', $bleed->user_id) !!}
                <div class="row">
                    <div class="small-20 large-20 columns">
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('receiver_name', 'Receiver Name :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input class="inline" id="receiver_name" placeholder="Receiver Name" name="receiver_name" type="text" value="{{$bleed->receiver_name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 large-10 medium-10 columns left">
                                {!! Form::text('city', $bleed->city, array('class' => 'inline','id' => 'city','placeholder' => 'City Name')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('comments', 'Comments :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::textarea('comments', $bleed->comments, array('style' => 'margin: 0 0 1rem 0;', 'size' => '30x5', 'class' => 'inline','id' => 'comments','placeholder' => 'Comments')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('date', 'Bleed Date :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::text('date', date('d-M-y', strtotime($bleed->date)), array('class' => 'inline datetimepicker','id' => 'date','placeholder' => 'Date')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div id="submit_btn" class="small-20 medium-20 large-20 columns">
                                <input type="submit" class="small button radius" name="submit" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
</section>

@include('admin.footer')