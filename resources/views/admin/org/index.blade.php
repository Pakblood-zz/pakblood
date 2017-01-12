@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row">
            <h3 class="page_heading">Organizations </h3>
            <a style="position: absolute;right: 0px;top: 2.5%;" href="{{url('/admin/organization/create')}}"
               class="button radius">Add New Organization </a>
            <div class="bg_icon">
                <li class="fi-torsos-all size-72"></li>
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
            <div class="row">
                {!! Form::open(array('url' => 'admin/organization/filter')) !!}
                <div class="">
                    <div class="hide-for-small-only medium-3 large-3 columns">
                        {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-5 large-5 columns left">
                        <input type="email" id="email" name="email" class="inline" placeholder="Email Address"
                               value="<?php if (isset($email)) echo $email?>">
                    </div>
                </div>
                <div class="">
                    <div class="hide-for-small-only medium-3 large-3 columns">
                        {!! Form::label('status', 'Status :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-5 large-5 columns left">
                        <label>
                            <select name="status">
                                <option <?php if (isset($status) && $status == 'all') echo 'selected'?> value="all">
                                    All
                                </option>
                                <option <?php if (isset($status) && $status == 'pending') echo 'selected'?> value="pending">
                                    Pending Approval
                                </option>
                                <option <?php if (isset($status) && $status == 'active') echo 'selected'?> value="active">
                                    Active
                                </option>
                                <option <?php if (isset($status) && $status == 'inactive') echo 'selected'?> value="inactive">
                                    Inactive
                                </option>
                                <option <?php if (isset($status) && $status == 'deleted') echo 'selected'?> value="deleted">
                                    Deleted
                                </option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="">
                    <div class="small-4 medium-4 large-4 columns">
                        <input style="margin: 0;padding: 10px;" type="submit" class="small button radius" name="submit"
                               value="Search">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <table role="grid" style="width: 100%;">
                <tr>
                    <th>#</th>
                    <th>Organization Name</th>
                    <th>Admin Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="90">Options</th>
                </tr>
                <?php $count = $orgs->firstitem(); ?>
                @foreach($orgs as $org)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$org->name}}</td>
                        <td>{{$org->admin_name}}</td>
                        <td>{{$org->email}}</td>
                        <td>{{$org->status}}</td>
                        <td class="options_btn">
                            <a data-tooltip aria-haspopup="true" class="has-tip" title="View"
                               href="{{url('admin/organization/'.$org->id)}}">
                                <li class="fi-eye size-25"></li>
                            </a>
                            <a data-tooltip aria-haspopup="true" class="has-tip" title="Edit"
                               href="{{url('admin/organization/'.$org->id.'/edit')}}">
                                <li class="fi-page-edit size-25"></li>
                            </a>
                            @if(isset($status) && $status == 'deleted')
                                <a data-tooltip aria-haspopup="true" class="tip-left" title="Undo"
                                   href="{{url('/admin/organization/'.$org->id.'/delete')}}">
                                    <li class="fi-trash size-25"></li>
                                </a>
                            @else
                                @if($org->status == 'active')
                                    <a data-tooltip aria-haspopup="true" class="tip-left" title="Inactivate"
                                       href="{{url('admin/change/organization/status/'.$org->id)}}">
                                        <li class="fi-x-circle size-25"></li>
                                    </a>
                                @else
                                    <a data-tooltip aria-haspopup="true" class="tip-left" title="Activate"
                                       href="{{url('admin/change/organization/status/'.$org->id)}}">
                                        <li class="fi-checkbox size-25"></li>
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    <?php $count += 1; ?>
                @endforeach
            </table>
            <?php echo $orgs->appends(Request::all())->render(); ?>
        </div>
    </div>
</section>

@include('admin.footer')