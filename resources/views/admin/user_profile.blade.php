@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">{{$user->name}} </h3><div class="bg_icon"><li @if($user->gender == ('male')||('Male')) class="fi-torso size-72" @else class="fi-torso-female size-72" @endif></li></div></div>
        <div class="row">
            @if(Session::get('message') != NULL)
                @if((Session::has('type')) && (Session::get('type')=='success'))
                    <div data-alert class="alert-box success radius  small-20 medium-14 large-20 columns round" style="text-align: center;font-weight: bold;width: 60%;float: right;margin-right: 20%;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
                @if((Session::has('type')) && (Session::get('type')=='error'))
                    <div data-alert class="alert-box alert radius  small-20 medium-14 large-20 columns round" style="text-align: center;font-weight: bold;width: 60%;float: right;margin-right: 20%;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
            @endif
            @if(isset($type) && $type == 'view')
                <a class="small button" style="float: left;border-radius: 50px 5px 5px 50px;position: absolute;" href="{{url('/admin/users')}}">Go back</a>
                <table style="margin: auto;width: 60%;">
                    <tr>
                        <td>Name : </td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td>Email : </td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>Username : </td>
                        <td>{{$user->username}}</td>
                    </tr>
                    <tr>
                        <td>Gender : </td>
                        <td>{{$user->gender}}</td>
                    </tr>
                    <tr>
                        <td>Date Of Birth : </td>
                        <td>{{$user->dob}}</td>
                    </tr>
                    <tr>
                        <td>Address </td>
                        <td>{{$user->address}}</td>
                    </tr>
                    <tr>
                        <td>Contact Number : </td>
                        <td>{{$user->phone}} , {{$user->mobile}}</td>
                    </tr>
                    <tr>
                        <td>City : </td>
                        <td>{{$city->name}}</td>
                    </tr>
                    <tr>
                        <td>Blood Group : </td>
                        <td>{{$user->blood_group}}</td>
                    </tr>
                    <tr>
                        <td>Last Bleed : </td>
                        <td>{{$user->last_bleed}} <a href="{{url('/admin/user/'.$user->id.'/bleed/history')}}">View Details</a></td>
                    </tr>
                    <tr>
                        <td>Organization : </td>
                        <td>@if($org != NULL) {{$org->name}} @else Not Joined Any @endif</td>
                    </tr>
                    <tr>
                        <td>Account Status : </td>
                        <td>@if($user->is_deleted == 0) {{$user->status}} @else {{'Deleted'}} @endif</td>
                    </tr>
                    <tr>
                        <td>Joined : </td>
                        <td>{{$user->created_at}}</td>
                    </tr>
                </table>
                <div class="row">
                    <div style="text-align: center;margin-top: 20px;" class="small-20 medium-20 large-20 columns">
                        <a href="{{url('admin/edit/user/'.$user->id)}}" class="small button radius">Edit </a>
                        <a data-confirm href="{{url('admin/delete/user/'.$user->id)}}" class="small button radius secondary">Delete </a>
                    </div>
                </div>
            @endif
            @if(isset($type) && $type == 'edit')
                <a class="small button" style="border-radius: 50px 5px 5px 50px;" href="{{url('/admin/users')}}">Go back</a>
                {!! Form::open(array('url' => 'admin/edit/user','id' => 'add_member_form')) !!}
                {!! Form::hidden('id',$user->id) !!}
                <div class="row">
                    <div class="small-20 large-20 columns">
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('name', 'Name :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input class="inline" id="name" placeholder="Name" name="name" type="text" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('username', 'Username :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 large-10 medium-10 columns left">
                                <input class="inline" id="username" placeholder="Username" name="username" type="text" value="{{$user->username}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input class="inline" id="email" placeholder="Email" name="email" type="email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('gender', 'Gender :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <label>
                                    <select id="gender" name="gender">
                                        <option value="Male" <?php if(($user->gender)== 'Male') echo 'selected="selected"'; ?>>Male</option>
                                        <option value="Female" <?php if(($user->gender)== 'Female') echo 'selected="selected"'; ?>>Female</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('dob', 'Date Of Birth :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input type="text" id="dob" class="datetimepicker" name="dob" value="{{$user->dob}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('phone', 'Phone :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input class="inline" id="phone" placeholder="Phone Number" name="phone" type="text" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('mobile', 'Mobile# :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input class="inline" id="mobile" placeholder="Mobile Number" name="mobile" type="text" value="{{$user->mobile}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('address', 'Address :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input class="inline" id="address" placeholder="Address" name="address" type="text" value="{{$user->address}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <label>
                                    <select id="city" name="city_id">
                                        <option value="208"<?php if(($user->city_id)== '208') echo 'selected="selected"'; ?>>Lahore</option>
                                        <option value="169"<?php if(($user->city_id)== '169') echo 'selected="selected"'; ?>>Karachi</option>
                                        <option value="130"<?php if(($user->city_id)== '130') echo 'selected="selected"'; ?>>Islamabad</option>
                                        <option value="1"<?php if(($user->city_id)== '1') echo 'selected="selected"'; ?>>Abbotabad</option>
                                        <option value="4"<?php if(($user->city_id)== '4') echo 'selected="selected"'; ?>>Adda shaiwala</option>
                                        <option value="9"<?php if(($user->city_id)== '9') echo 'selected="selected"'; ?>>Arif wala</option>
                                        <option value="10"<?php if(($user->city_id)== '10') echo 'selected="selected"'; ?>>Arifwala</option>
                                        <option value="13"<?php if(($user->city_id)== '13') echo 'selected="selected"'; ?>>Badin</option>
                                        <option value="15"<?php if(($user->city_id)== '15') echo 'selected="selected"'; ?>>Bahawalpur</option>
                                        <option value="18"<?php if(($user->city_id)== '18') echo 'selected="selected"'; ?>>Barbar loi</option>
                                        <option value="25"<?php if(($user->city_id)== '25') echo 'selected="selected"'; ?>>Bhawal nagar</option>
                                        <option value="26"<?php if(($user->city_id)== '26') echo 'selected="selected"'; ?>>Bhera</option>
                                        <option value="28"<?php if(($user->city_id)== '28') echo 'selected="selected"'; ?>>Bhirya road</option>
                                        <option value="30"<?php if(($user->city_id)== '30') echo 'selected="selected"'; ?>>Bhurewala</option>
                                        <option value="41"<?php if(($user->city_id)== '41') echo 'selected="selected"'; ?>>Chakwal</option>
                                        <option value="42"<?php if(($user->city_id)== '42') echo 'selected="selected"'; ?>>Charsada</option>
                                        <option value="68"<?php if(($user->city_id)== '68') echo 'selected="selected"'; ?>>Dera ghazi khan</option>
                                        <option value="76"<?php if(($user->city_id)== '76') echo 'selected="selected"'; ?>>Dina</option>
                                        <option value="85"<?php if(($user->city_id)== '85') echo 'selected="selected"'; ?>>Faisalabad</option>
                                        <option value="90"<?php if(($user->city_id)== '90') echo 'selected="selected"'; ?>>Feteh jhang</option>
                                        <option value="103"<?php if(($user->city_id)== '103') echo 'selected="selected"'; ?>>Ghotki</option>
                                        <option value="111"<?php if(($user->city_id)== '111') echo 'selected="selected"'; ?>>Gujranwala</option>
                                        <option value="112"<?php if(($user->city_id)== '112') echo 'selected="selected"'; ?>>Gujrat</option>
                                        <option value="118"<?php if(($user->city_id)== '118') echo 'selected="selected"'; ?>>Haroonabad</option>
                                        <option value="125"<?php if(($user->city_id)== '125') echo 'selected="selected"'; ?>>Hayatabad</option>
                                        <option value="129"<?php if(($user->city_id)== '129') echo 'selected="selected"'; ?>>Hyderabad</option>
                                        <option value="132"<?php if(($user->city_id)== '132') echo 'selected="selected"'; ?>>Jaccobabad</option>
                                        <option value="141"<?php if(($user->city_id)== '141') echo 'selected="selected"'; ?>>Jaranwala</option>
                                        <option value="147"<?php if(($user->city_id)== '147') echo 'selected="selected"'; ?>>Jhang</option>
                                        <option value="149"<?php if(($user->city_id)== '149') echo 'selected="selected"'; ?>>Jhelum</option>
                                        <option value="174"<?php if(($user->city_id)== '174') echo 'selected="selected"'; ?>>Kasur</option>
                                        <option value="176"<?php if(($user->city_id)== '176') echo 'selected="selected"'; ?>>Khair pur</option>
                                        <option value="181"<?php if(($user->city_id)== '181') echo 'selected="selected"'; ?>>Khanewal</option>
                                        <option value="186"<?php if(($user->city_id)== '186') echo 'selected="selected"'; ?>>Khewra</option>
                                        <option value="193"<?php if(($user->city_id)== '193') echo 'selected="selected"'; ?>>Kot addu</option>
                                        <option value="202"<?php if(($user->city_id)== '202') echo 'selected="selected"'; ?>>Kotli loharan</option>
                                        <option value="203"<?php if(($user->city_id)== '203') echo 'selected="selected"'; ?>>Kotri</option>
                                        <option value="227"<?php if(($user->city_id)== '227') echo 'selected="selected"'; ?>>Mandi bahauddin</option>
                                        <option value="232"<?php if(($user->city_id)== '232') echo 'selected="selected"'; ?>>Mangla</option>
                                        <option value="249"<?php if(($user->city_id)== '249') echo 'selected="selected"'; ?>>Mirpur khas</option>
                                        <option value="256"<?php if(($user->city_id)== '256') echo 'selected="selected"'; ?>>Multan</option>
                                        <option value="262"<?php if(($user->city_id)== '262') echo 'selected="selected"'; ?>>Muzaffarabad</option>
                                        <option value="266"<?php if(($user->city_id)== '266') echo 'selected="selected"'; ?>>Narowal</option>
                                        <option value="275"<?php if(($user->city_id)== '275') echo 'selected="selected"'; ?>>Nowshera</option>
                                        <option value="278"<?php if(($user->city_id)== '278') echo 'selected="selected"'; ?>>Okara</option>
                                        <option value="285"<?php if(($user->city_id)== '285') echo 'selected="selected"'; ?>>Patoki</option>
                                        <option value="286"<?php if(($user->city_id)== '286') echo 'selected="selected"'; ?>>Peshawar</option>
                                        <option value="302"<?php if(($user->city_id)== '302') echo 'selected="selected"'; ?>>Rahimyar khan</option>
                                        <option value="304"<?php if(($user->city_id)== '304') echo 'selected="selected"'; ?>>Raiwand</option>
                                        <option value="311"<?php if(($user->city_id)== '311') echo 'selected="selected"'; ?>>Rawalpindi</option>
                                        <option value="316"<?php if(($user->city_id)== '316') echo 'selected="selected"'; ?>>Sadiqabad</option>
                                        <option value="318"<?php if(($user->city_id)== '318') echo 'selected="selected"'; ?>>Sahiwal</option>
                                        <option value="332"<?php if(($user->city_id)== '332') echo 'selected="selected"'; ?>>Sargodha</option>
                                        <option value="341"<?php if(($user->city_id)== '341') echo 'selected="selected"'; ?>>Shaikhupura</option>
                                        <option value="350"<?php if(($user->city_id)== '350') echo 'selected="selected"'; ?>>Sialkot</option>
                                        <option value="358"<?php if(($user->city_id)== '358') echo 'selected="selected"'; ?>>Sohawa district jelum</option>
                                        <option value="365"<?php if(($user->city_id)== '365') echo 'selected="selected"'; ?>>Talhur</option>
                                        <option value="374"<?php if(($user->city_id)== '374') echo 'selected="selected"'; ?>>Taxila</option>
                                        <option value="381"<?php if(($user->city_id)== '381') echo 'selected="selected"'; ?>>Topi</option>
                                        <option value="391"<?php if(($user->city_id)== '391') echo 'selected="selected"'; ?>>Vehari</option>
                                        <option value="392"<?php if(($user->city_id)== '392') echo 'selected="selected"'; ?>>Wah cantt</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('bgroup', 'Blood Group :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <label>
                                    <select id="bgroup" name="bgroup">
                                        <option value="A+"<?php if(($user->blood_group)== 'ap') echo 'selected="selected"'; ?>>A+</option>
                                        <option value="A-"<?php if(($user->blood_group)== 'an') echo 'selected="selected"'; ?>>A-</option>
                                        <option value="B+"<?php if(($user->blood_group)== 'bp') echo 'selected="selected"'; ?>>B+</option>
                                        <option value="B-"<?php if(($user->blood_group)== 'bn') echo 'selected="selected"'; ?>>B-</option>
                                        <option value="O+"<?php if(($user->blood_group)== 'op') echo 'selected="selected"'; ?>>O+</option>
                                        <option value="O-"<?php if(($user->blood_group)== 'on') echo 'selected="selected"'; ?>>O-</option>
                                        <option value="AB+"<?php if(($user->blood_group)== 'abp') echo 'selected="selected"'; ?>>AB+</option>
                                        <option value="AB-"<?php if(($user->blood_group)== 'abn') echo 'selected="selected"'; ?>>AB-</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('last_bleed', 'Last Bleed :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input type="text" id="last_bleed" class="datetimepicker" name="last_bleed" value="{{$user->last_bleed}}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('org', 'Organization :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input type="text" id="org" value="@if($org != NULL ){{$org->name}} @endif" name="org">
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('status', 'Account Status :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <label>
                                    <select id="status" name="status">
                                        <option value="active"<?php if(($user->status)== 'active') echo 'selected="selected"'; ?>>Active </option>
                                        <option value="inactive"<?php if(($user->status)== 'inactive') echo 'selected="selected"'; ?>>Inactive </option>
                                        <option value="reported"<?php if(($user->status)== 'reported') echo 'selected="selected"'; ?>>Reported </option>
                                    </select>
                                </label>
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