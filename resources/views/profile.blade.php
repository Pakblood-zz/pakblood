@include('header')
<!-- Search area -->
<div class="row search-bar">
    <div class="myCenter">
        <div class="small-20 medium-20 large-7 colums left donors">
            <h3>1020 Donors</h3>
            <span>163 Organizations Registered</span>
        </div>
        <div class="medium-10 large-5 columns">
            <select>
                <option value="">Blood Group</option>
                <option value="Ap">A+</option>
                <option value="An">A-</option>
                <option value="ABp">AB+</option>
                <option value="ABn">AB-</option>
                <option value="Bp">B+</option>
                <option value="Bn">B-</option>
                <option value="Op">O+</option>
                <option value="On">O-</option>
            </select>
        </div>
        <div class="medium-10 large-5 columns">
            <select>
                <option value="">Location/City</option>
                <option value="208">Lahore</option>
                <option value="169">Karachi</option>
                <option value="130">Islamabad</option>
                <option value="1">Abbotabad</option>
                <option value="4">Adda shaiwala</option>
                <option value="9">Arif wala</option>
                <option value="10">Arifwala</option>
                <option value="13">Badin</option>
                <option value="15">Bahawalpur</option>
                <option value="18">Barbar loi</option>
                <option value="25">Bhawal nagar</option>
                <option value="26">Bhera</option>
                <option value="28">Bhirya road</option>
                <option value="30">Bhurewala</option>
                <option value="41">Chakwal</option>
                <option value="42">Charsada</option>
                <option value="68">Dera ghazi khan</option>
                <option value="76">Dina</option>
                <option value="85">Faisalabad</option>
                <option value="90">Feteh jhang</option>
                <option value="103">Ghotki</option>
                <option value="111">Gujranwala</option>
                <option value="112">Gujrat</option>
                <option value="118">Haroonabad</option>
                <option value="125">Hayatabad</option>
                <option value="129">Hyderabad</option>
                <option value="132">Jaccobabad</option>
                <option value="141">Jaranwala</option>
                <option value="147">Jhang</option>
                <option value="149">Jhelum</option>
                <option value="174">Kasur</option>
                <option value="176">Khair pur</option>
                <option value="181">Khanewal</option>
                <option value="186">Khewra</option>
                <option value="193">Kot addu</option>
                <option value="202">Kotli loharan</option>
                <option value="203">Kotri</option>
                <option value="227">Mandi bahauddin</option>
                <option value="232">Mangla</option>
                <option value="249">Mirpur khas</option>
                <option value="256">Multan</option>
                <option value="262">Muzaffarabad</option>
                <option value="266">Narowal</option>
                <option value="275">Nowshera</option>
                <option value="278">Okara</option>
                <option value="285">Patoki</option>
                <option value="286">Peshawar</option>
                <option value="302">Rahimyar khan</option>
                <option value="304">Raiwand</option>
                <option value="311">Rawalpindi</option>
                <option value="316">Sadiqabad</option>
                <option value="318">Sahiwal</option>
                <option value="332">Sargodha</option>
                <option value="341">Shaikhupura</option>
                <option value="350">Sialkot</option>
                <option value="358">Sohawa district jelum</option>
                <option value="365">Talhur</option>
                <option value="374">Taxila</option>
                <option value="381">Topi</option>
                <option value="391">Vehari</option>
                <option value="392">Wah cantt</option>
            </select>
        </div>
        <div id="search-btn" class="medium-20 large-3 columns">
            <a href="#" class="button radius"><span>Search</span></a>
        </div>
    </div>
</div>
<!-- Center Container-->
<div class="row center-container profile">
    @if(Session::get('message') != NULL)
        <div data-alert class="alert-box success radius  small-20 medium-14 large-20 columns round" style="text-align: center;font-weight: bold;">
            {{ Session::get('message') }}
            <a href="#" class="close">&times;</a>
        </div>
    @endif
    <ul class="tabs" data-tab role="tablist">
        <li class="tab-title active" role="presentation"><a href="#main" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-1">Main </a></li>
        <li class="tab-title" role="presentation"><a href="#ediprofile" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-2">Edit Profile</a></li>
        <li class="tab-title" role="presentation"><a href="#editlogin" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-3">Edit Login</a></li>
        @if(Auth::user()->org_id == 0)
        <li class="tab-title" role="presentation"><a href="#org" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-3">Join Organization</a></li>
        @endif
    </ul>
    <div class="tabs-content">
        <section role="tabpanel" aria-hidden="false" class="content active" id="main">
            <div class="row">
                <div class="small-20 large-10 columns">
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>Name : </p>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <p>{{Auth::user()->name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>Username : </p>
                        </div>
                        <div class="small-20 large-10 medium-10 columns left">
                            <p>{{Auth::user()->username}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>Email : </p>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <p>{{Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>Gender : </p>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <p>{{Auth::user()->gender}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>Date Of Birth : </p>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <p>{{Auth::user()->dob}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>Phone# : </p>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <p>{{Auth::user()->phone}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>Address : </p>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <p>{{Auth::user()->address}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>City : </p>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <p>{{Auth::user()->city_id}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <p>Blood Group : </p>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <p><?php
                                switch(Auth::user()->blood_group){
                                    case "ap": echo "A+";break;
                                    case "an": echo "A-";break;
                                    case "bp": echo "B+";break;
                                    case "bn": echo "B-";break;
                                    case "op": echo "O+";break;
                                    case "on": echo "O-";break;
                                    case "abp": echo "AB+";break;
                                    case "abn": echo "AB-";break;
                                }
                                ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section role="tabpanel" aria-hidden="true" class="content" id="ediprofile">
            {!! Form::open(array('url' => 'profile/update','id' => 'add_member_form')) !!}
            <div class="row">
                <div class="small-20 large-20 columns">
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('name', 'Name :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="name" placeholder="Name" name="name" type="text" value="{{Auth::user()->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('username', 'Username :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 large-10 medium-10 columns left">
                            <input class="inline" id="username" placeholder="Username" name="username" type="text" value="{{Auth::user()->username}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="email" placeholder="Email" name="email" type="email" value="{{Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('gender', 'Gender :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select id="gender" name="gender">
                                <option value="Male" <?php if((Auth::user()->gender)== 'Male') echo 'selected="selected"'; ?>>Male</option>
                                <option value="Female" <?php if((Auth::user()->gender)== 'Female') echo 'selected="selected"'; ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('dob', 'Date Of Birth :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input style="vertical-align: baseline;" type="date" id="dob" name="dob" value="{{Auth::user()->dob}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('phone', 'Phone :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="phone" placeholder="Phone Number" name="phone" type="text" value="{{Auth::user()->phone}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('address', 'Address :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="address" placeholder="Address" name="address" type="text" value="{{Auth::user()->address}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select id="city" name="city_id">
                                <option value="208"<?php if((Auth::user()->city_id)== '208') echo 'selected="selected"'; ?>>Lahore</option>
                                <option value="169"<?php if((Auth::user()->city_id)== '169') echo 'selected="selected"'; ?>>Karachi</option>
                                <option value="130"<?php if((Auth::user()->city_id)== '130') echo 'selected="selected"'; ?>>Islamabad</option>
                                <option value="1"<?php if((Auth::user()->city_id)== '1') echo 'selected="selected"'; ?>>Abbotabad</option>
                                <option value="4"<?php if((Auth::user()->city_id)== '4') echo 'selected="selected"'; ?>>Adda shaiwala</option>
                                <option value="9"<?php if((Auth::user()->city_id)== '9') echo 'selected="selected"'; ?>>Arif wala</option>
                                <option value="10"<?php if((Auth::user()->city_id)== '10') echo 'selected="selected"'; ?>>Arifwala</option>
                                <option value="13"<?php if((Auth::user()->city_id)== '13') echo 'selected="selected"'; ?>>Badin</option>
                                <option value="15"<?php if((Auth::user()->city_id)== '15') echo 'selected="selected"'; ?>>Bahawalpur</option>
                                <option value="18"<?php if((Auth::user()->city_id)== '18') echo 'selected="selected"'; ?>>Barbar loi</option>
                                <option value="25"<?php if((Auth::user()->city_id)== '25') echo 'selected="selected"'; ?>>Bhawal nagar</option>
                                <option value="26"<?php if((Auth::user()->city_id)== '26') echo 'selected="selected"'; ?>>Bhera</option>
                                <option value="28"<?php if((Auth::user()->city_id)== '28') echo 'selected="selected"'; ?>>Bhirya road</option>
                                <option value="30"<?php if((Auth::user()->city_id)== '30') echo 'selected="selected"'; ?>>Bhurewala</option>
                                <option value="41"<?php if((Auth::user()->city_id)== '41') echo 'selected="selected"'; ?>>Chakwal</option>
                                <option value="42"<?php if((Auth::user()->city_id)== '42') echo 'selected="selected"'; ?>>Charsada</option>
                                <option value="68"<?php if((Auth::user()->city_id)== '68') echo 'selected="selected"'; ?>>Dera ghazi khan</option>
                                <option value="76"<?php if((Auth::user()->city_id)== '76') echo 'selected="selected"'; ?>>Dina</option>
                                <option value="85"<?php if((Auth::user()->city_id)== '85') echo 'selected="selected"'; ?>>Faisalabad</option>
                                <option value="90"<?php if((Auth::user()->city_id)== '90') echo 'selected="selected"'; ?>>Feteh jhang</option>
                                <option value="103"<?php if((Auth::user()->city_id)== '103') echo 'selected="selected"'; ?>>Ghotki</option>
                                <option value="111"<?php if((Auth::user()->city_id)== '111') echo 'selected="selected"'; ?>>Gujranwala</option>
                                <option value="112"<?php if((Auth::user()->city_id)== '112') echo 'selected="selected"'; ?>>Gujrat</option>
                                <option value="118"<?php if((Auth::user()->city_id)== '118') echo 'selected="selected"'; ?>>Haroonabad</option>
                                <option value="125"<?php if((Auth::user()->city_id)== '125') echo 'selected="selected"'; ?>>Hayatabad</option>
                                <option value="129"<?php if((Auth::user()->city_id)== '129') echo 'selected="selected"'; ?>>Hyderabad</option>
                                <option value="132"<?php if((Auth::user()->city_id)== '132') echo 'selected="selected"'; ?>>Jaccobabad</option>
                                <option value="141"<?php if((Auth::user()->city_id)== '141') echo 'selected="selected"'; ?>>Jaranwala</option>
                                <option value="147"<?php if((Auth::user()->city_id)== '147') echo 'selected="selected"'; ?>>Jhang</option>
                                <option value="149"<?php if((Auth::user()->city_id)== '149') echo 'selected="selected"'; ?>>Jhelum</option>
                                <option value="174"<?php if((Auth::user()->city_id)== '174') echo 'selected="selected"'; ?>>Kasur</option>
                                <option value="176"<?php if((Auth::user()->city_id)== '176') echo 'selected="selected"'; ?>>Khair pur</option>
                                <option value="181"<?php if((Auth::user()->city_id)== '181') echo 'selected="selected"'; ?>>Khanewal</option>
                                <option value="186"<?php if((Auth::user()->city_id)== '186') echo 'selected="selected"'; ?>>Khewra</option>
                                <option value="193"<?php if((Auth::user()->city_id)== '193') echo 'selected="selected"'; ?>>Kot addu</option>
                                <option value="202"<?php if((Auth::user()->city_id)== '202') echo 'selected="selected"'; ?>>Kotli loharan</option>
                                <option value="203"<?php if((Auth::user()->city_id)== '203') echo 'selected="selected"'; ?>>Kotri</option>
                                <option value="227"<?php if((Auth::user()->city_id)== '227') echo 'selected="selected"'; ?>>Mandi bahauddin</option>
                                <option value="232"<?php if((Auth::user()->city_id)== '232') echo 'selected="selected"'; ?>>Mangla</option>
                                <option value="249"<?php if((Auth::user()->city_id)== '249') echo 'selected="selected"'; ?>>Mirpur khas</option>
                                <option value="256"<?php if((Auth::user()->city_id)== '256') echo 'selected="selected"'; ?>>Multan</option>
                                <option value="262"<?php if((Auth::user()->city_id)== '262') echo 'selected="selected"'; ?>>Muzaffarabad</option>
                                <option value="266"<?php if((Auth::user()->city_id)== '266') echo 'selected="selected"'; ?>>Narowal</option>
                                <option value="275"<?php if((Auth::user()->city_id)== '275') echo 'selected="selected"'; ?>>Nowshera</option>
                                <option value="278"<?php if((Auth::user()->city_id)== '278') echo 'selected="selected"'; ?>>Okara</option>
                                <option value="285"<?php if((Auth::user()->city_id)== '285') echo 'selected="selected"'; ?>>Patoki</option>
                                <option value="286"<?php if((Auth::user()->city_id)== '286') echo 'selected="selected"'; ?>>Peshawar</option>
                                <option value="302"<?php if((Auth::user()->city_id)== '302') echo 'selected="selected"'; ?>>Rahimyar khan</option>
                                <option value="304"<?php if((Auth::user()->city_id)== '304') echo 'selected="selected"'; ?>>Raiwand</option>
                                <option value="311"<?php if((Auth::user()->city_id)== '311') echo 'selected="selected"'; ?>>Rawalpindi</option>
                                <option value="316"<?php if((Auth::user()->city_id)== '316') echo 'selected="selected"'; ?>>Sadiqabad</option>
                                <option value="318"<?php if((Auth::user()->city_id)== '318') echo 'selected="selected"'; ?>>Sahiwal</option>
                                <option value="332"<?php if((Auth::user()->city_id)== '332') echo 'selected="selected"'; ?>>Sargodha</option>
                                <option value="341"<?php if((Auth::user()->city_id)== '341') echo 'selected="selected"'; ?>>Shaikhupura</option>
                                <option value="350"<?php if((Auth::user()->city_id)== '350') echo 'selected="selected"'; ?>>Sialkot</option>
                                <option value="358"<?php if((Auth::user()->city_id)== '358') echo 'selected="selected"'; ?>>Sohawa district jelum</option>
                                <option value="365"<?php if((Auth::user()->city_id)== '365') echo 'selected="selected"'; ?>>Talhur</option>
                                <option value="374"<?php if((Auth::user()->city_id)== '374') echo 'selected="selected"'; ?>>Taxila</option>
                                <option value="381"<?php if((Auth::user()->city_id)== '381') echo 'selected="selected"'; ?>>Topi</option>
                                <option value="391"<?php if((Auth::user()->city_id)== '391') echo 'selected="selected"'; ?>>Vehari</option>
                                <option value="392"<?php if((Auth::user()->city_id)== '392') echo 'selected="selected"'; ?>>Wah cantt</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('bgroup', 'Blood Group :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select id="bgroup" name="bgroup">
                                <option value="ap"<?php if((Auth::user()->blood_group)== 'ap') echo 'selected="selected"'; ?>>A+</option>
                                <option value="an"<?php if((Auth::user()->blood_group)== 'an') echo 'selected="selected"'; ?>>A-</option>
                                <option value="bp"<?php if((Auth::user()->blood_group)== 'bp') echo 'selected="selected"'; ?>>B+</option>
                                <option value="bn"<?php if((Auth::user()->blood_group)== 'bn') echo 'selected="selected"'; ?>>B-</option>
                                <option value="op"<?php if((Auth::user()->blood_group)== 'op') echo 'selected="selected"'; ?>>O+</option>
                                <option value="on"<?php if((Auth::user()->blood_group)== 'on') echo 'selected="selected"'; ?>>O-</option>
                                <option value="abp"<?php if((Auth::user()->blood_group)== 'abp') echo 'selected="selected"'; ?>>AB+</option>
                                <option value="abn"<?php if((Auth::user()->blood_group)== 'abn') echo 'selected="selected"'; ?>>AB-</option></select>
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
        </section>
        <section role="tabpanel" aria-hidden="true" class="content" id="editlogin">
            <div id="login" class="row">
                <div>
                    {!! Form::open(array('url' => 'rest/password','class' => 'small-20 medium-10 large-8 columns','style' => 'margin: auto 30%;')) !!}
                    <h5>Change Password</h5>
                    @if (count($errors) > 0)
                        <div class="row">
                            @foreach ($errors->all() as $error)
                                <small class="error small-20 medium-14 large-20 columns">{{ $error }}</small>
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="hide-for-small-only medium-6 large-6 columns">
                            {!! Form::label('email', 'E-Mail Address :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-14 large-14 columns left">
                            {!! Form::email('email', Input::old('email'), array('class' => 'inline','id' => 'email','placeholder' => 'Email')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-6 large-6 columns">
                            {!! Form::label('pass', 'Password :',array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-14 large-14 columns left">
                            {!! Form::password('password', array('class' => 'inline','id' => 'pass','placeholder' => 'Password')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-6 large-6 columns">
                            {!! Form::label('password_confirmation', 'Confirm Password :',array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-14 large-14 columns left">
                            {!! Form::password('password_confirmation', array('class' => 'inline','id' => 'pass','placeholder' => 'Confirm Password')) !!}
                        </div>
                    </div>
                    <div class="login_btn small-20 medium-14 large-15 columns">
                        <input type="submit" class="small button radius" name="submit" value="Rest Password">
                    </div>
                </div>
            </div>
        </section>
        <section role="tabpanel" aria-hidden="true" class="content" id="org"></section>
    </div>
</div>
@include('footer')