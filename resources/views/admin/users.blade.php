@include('admin.head')
@include('admin.side_bar')
<?php use Carbon\Carbon; ?>
<section class="main-section">
    <div class="page_wrapper">
        <div class="row">
            @if(isset($type) && $type == 'deleted')
                <h3 class="page_heading">Deleted Users </h3>
                <div class="bg_icon">
                    <li class="fi-torsos-all size-72"></li>
                </div>
            @else
                <h3 class="page_heading">Users </h3>
                <a style="position: absolute;right: 0px;top: 2.5%;" href="{{url('/admin/add/user')}}" class="button radius">Add New User</a>
                <div class="bg_icon">
                    <li class="fi-torsos-all size-72"></li>
                </div>
            @endif
        </div>
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
            @if(isset($type) && $type == 'deleted')
                <div class="row">
                    {!! Form::open(array('url' => 'admin/deleted/users')) !!}
                    {!! Form::hidden('is_deleted',1) !!}
                    {!! Form::hidden('type', 'deleted') !!}
                    <div class="">
                        <div class="hide-for-small-only medium-3 large-3 columns">
                            {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-5 large-5 columns left">
                            <input type="email" id="email" name="email" class="inline" placeholder="Email Address" value="<?php if(isset($email)) echo $email?>">
                        </div>
                    </div>
                    <div class="">
                        <div class="hide-for-small-only medium-3 large-3 columns">
                            {!! Form::label('status', 'User Status :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-5 large-5 columns left">
                            <label>
                                <select name="status">
                                    <option <?php if(isset($status) && $status == 'all') echo 'selected'?> value="all">All </option>
                                    <option <?php if(isset($status) && $status == 'active') echo 'selected'?> value="active">Active </option>
                                    <option <?php if(isset($status) && $status == 'inactive') echo 'selected'?> value="inactive">Inactive </option>
                                    <option <?php if(isset($status) && $status == 'reported') echo 'selected'?> value="reported">Reported </option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="">
                        <div class="small-4 medium-4 large-4 columns">
                            <input style="margin: 0;padding: 10px;" type="submit" class="small button radius" name="submit" value="Search">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <table role="grid" style="width: 100%;">
                    <tr>
                        <th>#</th>
                        <th>Name </th>
                        <th>Email </th>
                        <th>Contact Infomation</th>
                        <th>Address </th>
                        <th>Status </th>
                        <th width="90">Options </th>
                    </tr>
                    <?php $usercount = $users->firstitem(); ?>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$usercount}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}} </br> {{$user->mobile}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->status}}</td>
                            <td class="options_btn">
                                <a data-tooltip aria-haspopup="true" class="tip-left" title="Undo Delete" href="{{url('admin/undo/delete/user/'.$user->id)}}">
                                    <li class="fi-checkbox size-25"></li>
                                </a>
                            </td>
                        </tr>
                        <?php $usercount += 1; ?>
                    @endforeach
                </table>
                <?php echo $users->appends(Request::all())->render(); ?>
            @else
                <div class="row">
                    {!! Form::open(array('url' => 'admin/users')) !!}
                    {!! Form::hidden('is_deleted',0) !!}
                    {!! Form::hidden('type', 'deleted') !!}
                    <div class="">
                        <div class="hide-for-small-only medium-3 large-3 columns">
                            {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-5 large-5 columns left">
                            <input type="email" id="email" name="email" class="inline" placeholder="Email Address" value="<?php if(isset($email)) echo $email?>">
                        </div>
                    </div>
                    <div class="">
                        <div class="hide-for-small-only medium-3 large-3 columns">
                            {!! Form::label('status', 'User Status :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-5 large-5 columns left">
                            <label>
                                <select name="status">
                                    <option <?php if(isset($status) && $status == 'all') echo 'selected'?> value="all">All </option>
                                    <option <?php if(isset($status) && $status == 'active') echo 'selected'?> value="active">Active </option>
                                    <option <?php if(isset($status) && $status == 'inactive') echo 'selected'?> value="inactive">Inactive </option>
                                    <option <?php if(isset($status) && $status == 'reported') echo 'selected'?> value="reported">Reported </option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="">
                        <div class="small-4 medium-4 large-4 columns">
                            <input style="margin: 0;padding: 10px;" type="submit" class="small button radius" name="submit" value="Search">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <table role="grid" style="width: 100%;">
                    <tr>
                        <th>#</th>
                        <th>Name </th>
                        <th>Email </th>
                        <th>Contact Infomation</th>
                        <th>Address </th>
                        <th>Last Bleed </th>
                        <th>Status </th>
                        <th width="90">Options </th>
                    </tr>
                    <?php $usercount = $users->firstitem(); ?>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$usercount}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}} </br> {{$user->mobile}}</td>
                            <td>{{$user->address}}</td>
                            <?php
                            $created = new Carbon($user->last_bleed);
                            $now = Carbon::now();
                            $difference = ($created->diff($now)->days < 1)
                                    ? 'today'
                                    : $created->diffForHumans($now);
                            ?>
                            <td>{{$difference}}</td>
                            <td>{{$user->status}}</td>
                            <td class="options_btn">
                                <a data-tooltip aria-haspopup="true" class="has-tip" title="View" href="{{url('admin/user/'.$user->id)}}"> <li class="fi-eye size-25"></li> </a>
                                <a data-tooltip aria-haspopup="true" class="has-tip" title="Edit" href="{{url('admin/edit/user/'.$user->id)}}"><li class="fi-page-edit size-25"></li> </a>
                                @if($user->status == 'active')
                                    <a data-tooltip aria-haspopup="true" class="tip-left" title="Inactivate" href="{{url('admin/change/user/status/'.$user->id)}}">
                                        <li class="fi-x-circle size-25"></li>
                                    </a>
                                @else
                                    <a data-tooltip aria-haspopup="true" class="tip-left" title="Activate" href="{{url('admin/change/user/status/'.$user->id)}}">
                                        <li class="fi-checkbox size-25"></li>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <?php $usercount += 1; ?>
                    @endforeach
                </table>
                <?php echo $users->appends(Request::all())->render(); ?>
            @endif
        </div>
    </div>
</section>

@include('admin.footer')