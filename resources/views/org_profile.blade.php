@include('header')
@include('search_bar')
<style>
    .org_profile div, .org_profile p{
        text-align: center;
    }
    .org_profile table{
        margin: 5px auto;
    }
</style>
<!-- Center Container-->
<div class="row center-container profile">
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
    {{-- If user is not registered --}}
    @if(Auth::guest())
        <div class="org_profile">
            <h4>{{$org->name}}</h4>
            <div class="row">
                {!! HTML::image('images/'.$org->image, $org->name.' Logo')!!}
            </div>
            <p>
                <b>Please Allow 30-45 mints to {{$org->name}} to confirm that blood you need is available with them.</br>
                    If its available then its your duty to pick and drop the donor.</b>
            </p>
            <table>
                <tr>
                    <td>Organization Name : </td>
                    <td>{{$org->name}}</td>
                </tr>
                <tr>
                    <td>Address </td>
                    <td>{{$org->address}}</td>
                </tr>
                <tr>
                    <td>Contact Number : </td>
                    <td>{{$org->phone}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Administrator Name : </td>
                    <td>{{$org->admin_name}}</td>
                </tr>
                <tr>
                    <td>Contact Number : </td>
                    <td>{{$org->mobile}}</td>
                </tr>
                <tr>
                    <td>Email Address : </td>
                    <td>{{$org->email}}</td>
                </tr>
            </table>
        </div>
    @endif
    {{-- If user is registered but have not joined or created any organization yet--}}
    @if(!Auth::guest() && Auth::user()->org_id == 0)
        <div class="large-10 left">
            <h4>{{$org->name}}</h4>
            <div class="row">
                {!! HTML::image('images/'.$org->image, $org->name.' Logo')!!}
            </div>
            <table>
                <tr>
                    <td>Organization Name : </td>
                    <td>{{$org->name}}</td>
                </tr>
                <tr>
                    <td>Address </td>
                    <td>{{$org->address}}</td>
                </tr>
                <tr>
                    <td>Contact Number : </td>
                    <td>{{$org->phone}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Administrator Name : </td>
                    <td>{{$org->admin_name}}</td>
                </tr>
                <tr>
                    <td>Contact Number : </td>
                    <td>{{$org->mobile}}</td>
                </tr>
                <tr>
                    <td>Email Address : </td>
                    <td>{{$org->email}}</td>
                </tr>
            </table>
        </div>
        {!! Form::open(array('url' => '/organization/join' )) !!}
        <div class="row">
            {!! Form::hidden('org_id', $org->id) !!}
            <div class="hide-for-small-only medium-7 large-5 columns">
                {!! Form::label('reason', 'Reason to join '.$org->name.' :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                {!! Form::textarea('reason', Input::old('reason'), array('style' => 'margin: 0 0 1rem 0;', 'size' => '30x5', 'class' => 'inline','id' => 'reason','placeholder' => 'Give your reason to join '.$org->name)) !!}
            </div>
            <div style="text-align: center;" class="small-20 medium-20 large-10 columns">
                <input type="submit" class="small button radius" name="submit" value="Join!">
            </div>
        </div>
        {!! Form::close() !!}
    @endif
    {{-- If user is registered and is admin of an organization --}}
    @if(!Auth::guest())
        @if(Auth::user()->org_id == $org->id)
            <ul class="tabs" data-tab role="tablist" data-options="deep_linking:true;scroll_to_content: false">
                <li class="tab-title active" role="presentation"><a href="#main" role="tab" tabindex="0" aria-selected="true" aria-controls="main">Main </a></li>
                <li class="tab-title" role="presentation"><a href="#editprofile" role="tab" tabindex="0" aria-selected="false" aria-controls="editprofile">Edit Profile </a></li>
                <li class="tab-title" role="presentation"><a href="#addmember" role="tab" tabindex="0" aria-selected="false" aria-controls="addmember">Add Member </a></li>
                <li class="tab-title" role="presentation"><a href="#viewmember" role="tab" tabindex="0" aria-selected="false" aria-controls="viewmember">View Member </a></li>
                <li class="tab-title" role="presentation"><a href="#viewrequests" role="tab" tabindex="0" aria-selected="false" aria-controls="viewrequests">View Requests  </a></li>
                <li class="tab-title" role="presentation"><a href="#adminsettings" role="tab" tabindex="0" aria-selected="false" aria-controls="adminsettings">Admin Settings </a></li>
            </ul>
            <div class="tabs-content">
                <section role="tabpanel" aria-hidden="false" class="content active" id="main">
                    <div class="org_profile">
                        <h4>{{$org->name}}</h4>
                        <div class="row">
                            {!! HTML::image('images/'.$org->image, $org->name.' Logo')!!}
                        </div>
                        <table>
                            <tr>
                                <td>Organization Name : </td>
                                <td>{{$org->name}}</td>
                            </tr>
                            <tr>
                                <td>Address </td>
                                <td>{{$org->address}}</td>
                            </tr>
                            <tr>
                                <td>Contact Number : </td>
                                <td>{{$org->phone}}</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Administrator Name : </td>
                                <td>{{$org->admin_name}}</td>
                            </tr>
                            <tr>
                                <td>Contact Number : </td>
                                <td>{{$org->mobile}}</td>
                            </tr>
                            <tr>
                                <td>Email Address : </td>
                                <td>{{$org->email}}</td>
                            </tr>
                        </table>
                    </div>
                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="editprofile">

                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="addmember">

                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="viewmember">

                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="viewrequests">

                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="adminsettings">

                </section>
            </div>
        @endif
    @endif
</div>
@include('footer')