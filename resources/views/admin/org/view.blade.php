@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">{{$org->name}} </h3>
            <div class="bg_icon">
                <li class="fi-torso size-72"></li>
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
            <a class="small button" style="border-radius: 50px 5px 5px 50px;position: absolute;"
               href="{{url('/admin/organization')}}">Go back</a>
            <table style="margin: auto;width: 60%;">
                <tr>
                    <td>Name :</td>
                    <td>{{$org->name}}</td>
                </tr>
                <tr>
                    <td>Address :</td>
                    <td>{{$org->address}}</td>
                </tr>
                <tr>
                    <td>Website :</td>
                    <td>{{$org->url}}</td>
                </tr>
                <tr>
                    <td>Contact Information :</td>
                    <td>{{$org->phone}} , {{$org->moble}}</td>
                </tr>
                <tr>
                    <td>City :</td>
                    <td>{{$city->name}}</td>
                </tr>
                <tr>
                    <td>Logo</td>
                    <td>
                        <div>
                            @if($org->image != '')
                                {!! HTML::image('images/logos/'.$org->image, $org->name.' Logo')!!}
                            @else
                                {!! HTML::image('images/logos/default.png', $org->name.' Logo')!!}
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Application</td>
                    <td>
                        <div>
                            @if($org->application_image != '')
                                {!! HTML::image('images/applications/'.$org->application_image, $org->name.' Application')!!}
                            @else
                                N/A
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Admin Name :</td>
                    <td>{{$org->admin_name}}</td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td>{{$org->email}}</td>
                </tr>
                <tr>
                    <td>Program :</td>
                    <td>{{$org->program}}</td>
                </tr>
                <tr>
                    <td>Status :</td>
                    <td>{{$org->status}}</td>
                </tr>
                <tr>
                    <td>Joined :</td>
                    <td>{{$org->created_at}}</td>
                </tr>
            </table>
            <div class="row">
                <div style="text-align: center;margin-top: 20px;" class="small-20 medium-20 large-20 columns">
                    <a href="{{url('/admin/organization/'.$org->id.'/edit')}}" class="small button radius">Edit </a>
                    <a data-confirm href="{{url('/admin/organization/'.$org->id.'/delete')}}"
                       class="small button radius secondary">Delete </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.footer')