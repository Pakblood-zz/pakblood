@include('header')
@include('search_bar')
        <!-- Center Container-->
<style>
    #countriesRegForm_chosen, #citiesRegForm_chosen {
        margin: 0;
    }
</style>
<div class="row center-container profile">
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
    <ul class="tabs" data-tab role="tablist" data-options="deep_linking:true;scroll_to_content: false">
        <li class="tab-title active" role="presentation"><a href="#profile" role="tab" tabindex="0" aria-selected="true"
                                                            aria-controls="profile">Profile </a></li>
        <li class="tab-title" role="presentation"><a href="#bleesstatus" role="tab" tabindex="0" aria-selected="true"
                                                     aria-controls="bleesstatus">Update Bleed Status </a></li>
        <li class="tab-title" role="presentation"><a href="#editprofile" role="tab" tabindex="0" aria-selected="false"
                                                     aria-controls="ediprofile">Edit Profile </a></li>
        @if($user->password != '')
            <li class="tab-title" role="presentation">
                <a href="#changepassword" role="tab" tabindex="0" aria-selected="false" aria-controls="changepassword">Change
                    Password </a>
            </li>
        @endif
        <li class="tab-title" role="presentation"><a href="#bleedhistory" role="tab" tabindex="0" aria-selected="false"
                                                     aria-controls="bleedhistory">Bleed History </a></li>
        <li class="tab-title" role="presentation"><a href="#unjoin" role="tab" tabindex="0" aria-selected="false"
                                                     aria-controls="unjoin">Unjoin </a></li>
    </ul>
    <div id="add_member" class="tabs-content">
        <section role="tabpanel" aria-hidden="true" class="content active" id="profile">
            <div class="row collapse">
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Name</span>
                    <span class="large-15 columns no-padding">{{ $user->name }}</span>
                </div>
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Username</span>
                    <span class="large-15 columns no-padding">{{ $user->username }}</span>
                </div>
                <hr>
            </div>
            <div class="row collapse">
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Email</span>
                    <span class="large-15 columns no-padding">{{ $user->email }}</span>
                </div>
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Gender</span>
                    <span class="large-15 columns no-padding">{{ $user->gender }}</span>
                </div>
                <hr>
            </div>
            <div class="row collapse">
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Date Of Birth</span>
                    <span class="large-15 columns no-padding">{{ $user->dob }}</span>
                </div>
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Phone#</span>
                    <span class="large-15 columns no-padding">{{ $user->phone }}</span>
                </div>
                <hr>
            </div>
            <div class="row collapse">
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Mobile#</span>
                    <span class="large-15 columns no-padding">{{ $user->mobile }}</span>
                </div>
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Address</span>
                    <span class="large-15 columns no-padding">{{ $user->address }}</span>
                </div>
                <hr>
            </div>
            <div class="row collapse">
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">City</span>
                    <span class="large-15 columns no-padding">{{ $user->city }}</span>
                </div>
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Blood Group</span>
                    <span class="large-15 columns no-padding">{{ $user->bg }}</span>
                </div>
                <hr>
            </div>
            <div class="row collapse">
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Last Bleed</span>
                    <span class="large-15 columns no-padding">{{ $user->last_bleed }}</span>
                </div>
                <div class="large-10 columns">
                    <span class="large-5 columns no-padding">Organization</span>
                    <span class="large-15 columns no-padding">
                     @if($user->org_id != 0)
                            {{ $user->org }}
                        @else
                            You have not joined any organization yet, you can
                            <a href="/create/organization">Register An Organization</a>
                            <span style="color: red;">Or</span>
                            <a href="/organizations">Join An Organization</a>
                        @endif
                    </span>
                </div>
                <hr>
            </div>
            <div class="row collapse">
                <div class="large-10 columns">
                    @if($user->fb_id == null)
                        <a href="{{ url('linkAccount/fb') }}">Connect Facebook</a>
                    @else
                        <a href="{{ url('https://www.facebook.com/'.$user->fb_id) }}" target="_blank">Connected With
                            Facebook</a>
                        @if($user->gp_id != null && $user->password == '')
                            <a href="{{ url('unlinkAccount/gp') }}" data-account="fb" style="margin-left: 20px;color: red;">Unlink</a>
                        @endif
                    @endif
                </div>
                <div class="large-10 columns">
                    @if($user->gp_id == null)
                        <a href="{{ url('linkAccount/gp') }}">Connect Google+</a>
                    @else
                        <a href="{{ url('https://plus.google.com/'.$user->gp_id) }}" target="_blank">Connected With
                            Google+</a>
                        @if($user->fb_id != null && $user->password == '')
                            <a href="{{ url('unlinkAccount/gp') }}" data-account="gp" style="margin-left: 20px;color: red;">Unlink</a>
                        @endif
                    @endif
                </div>
            </div>
        </section>
        <section role="tabpanel" aria-hidden="false" class="content" id="bleesstatus">
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
                            <input id="date" class="inline datetimepicker" name="date" type="text">
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
            {!! Form::open(array('action' => 'ProfileController@updateProfile','id' => 'add_member_form')) !!}
            <input type="hidden" name="_method" value="POST">
            <div class="row">
                <div class="small-20 large-20 columns">
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('name', 'Name :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="name" placeholder="Name" name="name" type="text"
                                   value="{{\Auth::user()->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('username', 'Username :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 large-10 medium-10 columns left">
                            <input class="inline" id="username" placeholder="Username" name="username" type="text"
                                   value="{{\Auth::user()->username}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="email" placeholder="Email" name="email" type="email"
                                   value="{{\Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('gender', 'Gender :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select id="gender" name="gender">
                                <option value="Male" <?php if ((\Auth::user()->gender) == 'Male') echo 'selected="selected"'; ?>>
                                    Male
                                </option>
                                <option value="Female" <?php if ((\Auth::user()->gender) == 'Female') echo 'selected="selected"'; ?>>
                                    Female
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('dob', 'Date Of Birth :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input type="text" id="dob" class="datetimepicker" name="dob"
                                   value="{{date('d-M-y',strtotime(\Auth::user()->dob))}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('phone', 'Phone :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="phone" placeholder="Phone Number" name="phone" type="text"
                                   value="{{\Auth::user()->phone}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('mobile', 'Mobile# :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="mobile" placeholder="Mobile Number" name="mobile" type="text"
                                   value="{{\Auth::user()->mobile}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('address', 'Address :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input class="inline" id="address" placeholder="Address" name="address" type="text"
                                   value="{{\Auth::user()->address}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('country', 'Country :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select name="country" id="countriesRegForm" data-placeholder="Choose a country..."
                                    class="chosen-select">
                                <option value=""></option>
                                @foreach($countries as $row)
                                    <option value="{{ $row->id }}" {{ (isset($user->country_id) && $user->country_id== $row->id)?"selected":"" }}>{{ $row->short_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select name="city" id="citiesRegForm" data-placeholder="Choose a city..."
                                    class="chosen-select" {{ (isset($user->city_id))?"":"disabled" }}>
                                <option value=""></option>
                                @if(isset($cities))
                                    @foreach($cities as $row)
                                        <option value="{{ $row->id }}" {{ (isset($user->city_id) && $user->city_id== $row->id)?"selected":"" }}>{{ $row->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('bgroup', 'Blood Group :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select id="bgroup" name="bgroup">
                                <option value="A+"<?php if ((Auth::user()->blood_group) == 'ap') echo 'selected="selected"'; ?>>
                                    A+
                                </option>
                                <option value="A-"<?php if ((Auth::user()->blood_group) == 'an') echo 'selected="selected"'; ?>>
                                    A-
                                </option>
                                <option value="B+"<?php if ((Auth::user()->blood_group) == 'bp') echo 'selected="selected"'; ?>>
                                    B+
                                </option>
                                <option value="B-"<?php if ((Auth::user()->blood_group) == 'bn') echo 'selected="selected"'; ?>>
                                    B-
                                </option>
                                <option value="O+"<?php if ((Auth::user()->blood_group) == 'op') echo 'selected="selected"'; ?>>
                                    O+
                                </option>
                                <option value="O-"<?php if ((Auth::user()->blood_group) == 'on') echo 'selected="selected"'; ?>>
                                    O-
                                </option>
                                <option value="AB+"<?php if ((Auth::user()->blood_group) == 'abp') echo 'selected="selected"'; ?>>
                                    AB+
                                </option>
                                <option value="AB-"<?php if ((Auth::user()->blood_group) == 'abn') echo 'selected="selected"'; ?>>
                                    AB-
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div id="submit_btn" class="small-20 medium-20 large-20 columns">
                            <input type="submit" class="small button radius" name="submit" value="Save">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                    <th>Receiver Name</th>
                    <th>City</th>
                    <th width="500">Comments</th>
                    <th width="180">Date</th>
                </tr>
                <?php $count = 1; ?>
                @foreach($bleed as $bs)
                    <tr>
                        <td><?php echo $count?></td>
                        <td>{{$bs->receiver_name}}</td>
                        <td>{{$bs->city}}</td>
                        <td>{{$bs->comments}}</td>
                        <td>{{$bs->date}}</td>
                    </tr>
                    <?php $count += 1; ?>
                @endforeach
            </table>
        </section>
        <section role="tabpanel" aria-hidden="true" class="content" id="unjoin">
            <div class="row">
                {!! Form::open(array('url' => 'delete/user','id' => 'add_member_form' ,'data-confirm' => ''))!!}
                <h5 style="text-align: center;">Unjoin Pakblood</h5>
                <div class="row">
                    <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                        <p style="text-align: center;border:none;">
                            Are you sure to leave Pakblood.com?</br>
                            If you are sure, click Unjoin button given below.</br></br>
                            Thanks for becoming a part of PAKBLOOD team.</br></br>
                            PAKBLOOD TEAM
                        </p>
                    </div>
                </div>
                <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                    <input type="submit" class="small button radius" value="Unoin">
                </div>
                {!! Form::close() !!}
            </div>
        </section>
    </div>
</div>
<script>
    //ID of select containing countries and ID of select containing cities.
    countryAndCitySelect('countriesRegForm', 'citiesRegForm');
</script>
@include('footer')