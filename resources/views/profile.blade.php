@include('header')
@include('search_bar')
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
    <ul class="tabs" data-tab role="tablist" data-options="deep_linking:true;scroll_to_content: false">
        <li class="tab-title active" role="presentation"><a href="#bleesstatus" role="tab" tabindex="0" aria-selected="true" aria-controls="bleesstatus">Update Bleed Status </a></li>
        <li class="tab-title" role="presentation"><a href="#editprofile" role="tab" tabindex="0" aria-selected="false" aria-controls="ediprofile">Edit Profile </a></li>
        <li class="tab-title" role="presentation"><a href="#changepassword" role="tab" tabindex="0" aria-selected="false" aria-controls="changepassword">Change Password </a></li>
        <li class="tab-title" role="presentation"><a href="#bleedhistory" role="tab" tabindex="0" aria-selected="false" aria-controls="bleedhistory">Bleed History </a></li>
        <li class="tab-title" role="presentation"><a href="#unjoin" role="tab" tabindex="0" aria-selected="false" aria-controls="unjoin">Unjoin </a></li>
    </ul>
    <div class="tabs-content">
        <section role="tabpanel" aria-hidden="false" class="content active" id="bleesstatus">
            {!! Form::open(array('url' => '/bleed/update','id' => 'add_member_form')) !!}
            <div class="row">
                <div class="small-20 large-20 columns">
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('receiver_name', 'Receiver Name :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::text('receiver_name', Input::old('receiver_name'), array('class' => 'inline','id' => 'receiver_name','placeholder' => 'Receiver Name')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::text('city', Input::old('city'), array('class' => 'inline','id' => 'city','placeholder' => 'City')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('comments', 'Comments :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::textarea('comments', Input::old('comments'), array('style' => 'margin: 0 0 1rem 0;', 'size' => '30x5', 'class' => 'inline','id' => 'comments','placeholder' => 'Comments')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('date', 'Date :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="date" name="date" type="date">
                        </div>
                    </div>
                    <div class="row">
                        <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                            <input type="submit" class="small button radius" name="submit" value="Save">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
        <section role="tabpanel" aria-hidden="true" class="content" id="editprofile">
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
                            {!! Form::label('mobile', 'Mobile# :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="mobile" placeholder="Mobile Number" name="mobile" type="text" value="{{Auth::user()->mobile}}">
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
                                <option value="A+"<?php if((Auth::user()->blood_group)== 'ap') echo 'selected="selected"'; ?>>A+</option>
                                <option value="A-"<?php if((Auth::user()->blood_group)== 'an') echo 'selected="selected"'; ?>>A-</option>
                                <option value="B+"<?php if((Auth::user()->blood_group)== 'bp') echo 'selected="selected"'; ?>>B+</option>
                                <option value="B-"<?php if((Auth::user()->blood_group)== 'bn') echo 'selected="selected"'; ?>>B-</option>
                                <option value="O+"<?php if((Auth::user()->blood_group)== 'op') echo 'selected="selected"'; ?>>O+</option>
                                <option value="O-"<?php if((Auth::user()->blood_group)== 'on') echo 'selected="selected"'; ?>>O-</option>
                                <option value="AB+"<?php if((Auth::user()->blood_group)== 'abp') echo 'selected="selected"'; ?>>AB+</option>
                                <option value="AB-"<?php if((Auth::user()->blood_group)== 'abn') echo 'selected="selected"'; ?>>AB-</option></select>
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
        <section role="tabpanel" aria-hidden="true" class="content" id="changepassword">
            <div id="login" class="row">
                {!! Form::open(array('url' => 'change/password','class' => 'small-20 medium-10 large-8 columns','style' => 'margin: auto 30%;')) !!}
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
                        {!! Form::label('old_password', 'Old Passowrd :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-14 large-14 columns left">
                        {!! Form::password('old_password', array('class' => 'inline','id' => 'old_password','placeholder' => 'Old Password')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="hide-for-small-only medium-6 large-6 columns">
                        {!! Form::label('new_password', 'New Password :',array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-14 large-14 columns left">
                        {!! Form::password('new_password', array('class' => 'inline','id' => 'new_password','placeholder' => 'New Password')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="hide-for-small-only medium-6 large-6 columns">
                        {!! Form::label('new_password_confirmation', 'Confirm New Password :',array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-14 large-14 columns left">
                        {!! Form::password('new_password_confirmation', array('class' => 'inline','id' => 'new_password_confirmation','placeholder' => 'Confirm New Password')) !!}
                    </div>
                </div>
                <div style="text-align: center;" class="login_btn small-20 medium-14 large-15 columns">
                    <input type="submit" class="small button radius" name="submit" value="Rest Password">
                </div>
                {!! Form::close() !!}
            </div>
        </section>
        <section role="tabpanel" aria-hidden="true" class="content" id="bleedhistory">
            <table role="grid">
                <tr>
                    <th>#</th>
                    <th>Receiver Name </th>
                    <th>City </th>
                    <th width="500">Comments </th>
                    <th width="180">Date </th>
                </tr>
                <?php $count=1; ?>
                @foreach($bleed as $bs)
                    <tr>
                        <td><?php echo $count?></td>
                        <td>{{$bs->receiver_name}}</td>
                        <td>{{$bs->city}}</td>
                        <td>{{$bs->comments}}</td>
                        <td>{{$bs->date}}</td>
                    </tr>
                    <?php $count+=1; ?>
                @endforeach
            </table>
        </section>
        <section role="tabpanel" aria-hidden="true" class="content" id="unjoin">
            <div class="row">
                {!! Form::open(array('url' => 'delete/user','id' => 'add_member_form')) !!}
                <h5 style="text-align: center;">Unjoin Pakblood</h5>
                <div class="row">
                    <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                        <p style="text-align: center;border:none;" >
                            Are you sure to leave Pakblood.com?</br>
                            If you are sure, click Unjoin button given below.</br></br>
                            Thanks for becoming a part of PAKBLOOD team.</br></br>
                            PAKBLOOD TEAM
                        </p>
                    </div>
                </div>
                <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                    <input type="submit" class="small button radius" name="submit" value="Unoin">
                </div>
                {!! Form::close() !!}
            </div>
        </section>
        <section role="tabpanel" aria-hidden="true" class="content" id="org"></section>
    </div>
</div>
@include('footer')