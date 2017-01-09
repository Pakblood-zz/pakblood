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
    @if (count($errors) > 0)
        <div>
            @foreach ($errors->all() as $error)
                <small class="error">{{ $error }}</small>
            @endforeach
        </div>
    @endif
    {{-- If user is not registered --}}
    @if(Auth::guest())
        <div class="org_profile">
            <h4>{{$org->name}}</h4>
            <div class="row">
                @if($org->image == null || $org->image == '')
                    {!! HTML::image('images/default.png', $org->name.' Logo', ['style'=>'max-width: 250px;height: auto;'])!!}
                @else
                    {!! HTML::image('images/logos/'.$org->image, $org->name.' Logo')!!}
                @endif
            </div>
            <p>
                <b>Please Allow 30-45 mints to {{$org->name}} to confirm that blood you need is available with
                    them.</br>
                    If its available then its your duty to pick and drop the donor.</b>
            </p>
            <table>
                <tr>
                    <td>Organization Name :</td>
                    <td>{{$org->name}}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{$org->address}}</td>
                </tr>
                <tr>
                    <td>Contact Number :</td>
                    <td>{{$org->phone}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Administrator Name :</td>
                    <td>{{$org->admin_name}}</td>
                </tr>
                <tr>
                    <td>Contact Number :</td>
                    <td>{{$org->mobile}}</td>
                </tr>
                <tr>
                    <td>Email Address :</td>
                    <td>{{$org->email}}</td>
                </tr>
            </table>
        </div>
    @endif
    {{-- If user is registered but have not joined or created any organization yet --}}
    @if(!Auth::guest() && (Auth::user()->org_id == 0 || Auth::user()->id != $org->user_id))
        <div @if(Auth::user()->org_id == 0) class="large-10 left" @else class="org_profile" @endif >
            <h4>{{$org->name}}</h4>
            <div class="row">
                @if($org->image == null || $org->image == '')
                    {!! HTML::image('images/default.png', $org->name.' Logo', ['style'=>'max-width: 250px;height: auto;'])!!}
                @else
                    {!! HTML::image('images/logos/'.$org->image, $org->name.' Logo')!!}
                @endif
            </div>
            <table>
                <tr>
                    <td>Organization Name :</td>
                    <td>{{$org->name}}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{$org->address}}</td>
                </tr>
                <tr>
                    <td>Contact Number :</td>
                    <td>{{$org->phone}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Administrator Name :</td>
                    <td>{{$org->admin_name}}</td>
                </tr>
                <tr>
                    <td>Contact Number :</td>
                    <td>{{$org->mobile}}</td>
                </tr>
                <tr>
                    <td>Email Address :</td>
                    <td>{{$org->email}}</td>
                </tr>
            </table>
        </div>
        @if(Auth::user()->org_id == 0)
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
    @endif
    {{-- If user is registered and is admin of an organization --}}
    @if(!Auth::guest())
        @if(Auth::user()->id == $org->user_id)
            <ul class="hide-for-small-down tabs" data-tab role="tablist"
                data-options="deep_linking:true;scroll_to_content: false">
                <li class="tab-title active" role="presentation"><a href="#profile" role="tab" tabindex="0"
                                                                    aria-selected="true"
                                                                    aria-controls="main">Profile </a>
                </li>
                <li class="tab-title" role="presentation"><a href="#editprofile" role="tab" tabindex="0"
                                                             aria-selected="false" aria-controls="editprofile">Edit
                        Profile </a></li>
                <li class="tab-title" role="presentation"><a href="#addmember" role="tab" tabindex="0"
                                                             aria-selected="false" aria-controls="addmember">Add
                        Member </a></li>
                <li class="tab-title" role="presentation"><a href="#viewmember" role="tab" tabindex="0"
                                                             aria-selected="false" aria-controls="viewmember">View
                        Member </a></li>
                <li class="tab-title" role="presentation"><a href="#viewrequests" role="tab" tabindex="0"
                                                             aria-selected="false" aria-controls="viewrequests">View
                        Requests </a></li>
                <li class="tab-title" role="presentation"><a href="#adminsettings" role="tab" tabindex="0"
                                                             aria-selected="false" aria-controls="adminsettings">Admin
                        Settings </a></li>
                <li class="tab-title" role="presentation"><a href="#deleteorganization" role="tab" tabindex="0"
                                                             aria-selected="false" aria-controls="deleteorganization">Delete
                        Organization </a></li>
            </ul>

            <div class="hide-for-medium-up">
                <label>
                    <select id="tabSelect">
                        <option value="#profile">Profile</option>
                        <option value="#editprofile">Edit Profile</option>
                        <option value="#addmember">Add Member</option>
                        <option value="#viewmember">View Member</option>
                        <option value="#viewrequests">View Requests</option>
                        <option value="#adminsettings">Admin Settings</option>
                        <option value="#deleteorganization">Delete Organization</option>
                    </select>
                </label>
            </div>
            <div id="add_member" class="tabs-content">
                <section role="tabpanel" aria-hidden="false" class="content active" id="profile">
                    <div class="org_profile">
                        <div class="row">
                            @if($org->image == null || $org->image == '')
                                {!! HTML::image('images/default.png', $org->name.' Logo', ['style'=>'max-width: 250px;height: auto;'])!!}
                            @else
                                {!! HTML::image('images/logos/'.$org->image, $org->name.' Logo')!!}
                            @endif
                        </div>
                        <div class="row collapse">
                            <div class="large-10 columns">
                                <span class="large-5 columns no-padding">Name:</span>
                                <span class="large-15 columns no-padding">{{ ($org->name != '')?$org->name:"N/A" }}</span>
                            </div>
                            <hr class="hide-for-medium-up">
                            <div class="large-10 columns">
                                <span class="large-5 columns no-padding">Address:</span>
                                <span class="large-15 columns no-padding">{{ ($org->address != '')?$org->address:"N/A" }}</span>
                            </div>
                            <hr>
                        </div>
                        <div class="row collapse">
                            <div class="large-10 columns">
                                <span class="large-5 columns no-padding">Phone#:</span>
                                <span class="large-15 columns no-padding">{{ ($org->phone != '')?$org->phone:"N/A" }}</span>
                            </div>
                            <hr class="hide-for-medium-up">
                            <div class="large-10 columns">
                                <span class="large-5 columns no-padding">Mobile#:</span>
                                <span class="large-15 columns no-padding">{{ ($org->mobile != '')?$org->mobile:"N/A" }}</span>
                            </div>
                            <hr>
                        </div>
                        <div class="row collapse">
                            <div class="large-10 columns">
                                <span class="large-5 columns no-padding">Admin Name:</span>
                                <span class="large-15 columns no-padding">{{ ($org->admin_name != '')?$org->admin_name:"N/A" }}</span>
                            </div>
                            <hr class="hide-for-medium-up">
                            <div class="large-10 columns">
                                <span class="large-5 columns no-padding">Email:</span>
                                <span class="large-15 columns no-padding">{{ ($org->email != '')?$org->email:"N/A" }}</span>
                            </div>
                            <hr>
                        </div>
                    </div>
                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="editprofile">
                    <div class="small-20 medium-20 large-20 columns">
                        <div id="add_org">
                            {!! Form::open(array('url' => '/organization/update')) !!}
                            <h5>Organization information</h5>
                            <input type="hidden" name="org_id" value="<?php echo $org->id?>">
                            <div class="small-20 large-20 columns">
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        {!! Form::label('org_name', 'Organization Name :' ,array('class' => 'inline')) !!}
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <input class="inline" id="org_name" placeholder="Organization Name"
                                               name="org_name" type="text" value="<?php echo $org->name?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        {!! Form::label('org_address', 'Organization Address :' ,array('class' => 'inline')) !!}
                                    </div>
                                    <div class="small-20 large-10 medium-10 columns left">
                                        <input class="inline" id="org_address" placeholder="Organization Address"
                                               name="org_address" type="text" value="<?php echo $org->address?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        {!! Form::label('org_phone', 'Organization Phone :' ,array('class' => 'inline')) !!}
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <input class="inline" id="org_phone" placeholder="Organization Phone"
                                               name="org_phone" type="text" value="<?php echo $org->phone?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="city" class="inline">Country : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <select name="country" id="countriesRegForm"
                                                data-placeholder="Choose a country..."
                                                class="chosen-select">
                                            <option value=""></option>
                                            @foreach($countries as $row)
                                                <option value="{{ $row->id }}" {{ (isset($orgCountry) && $orgCountry == $row->id)?"selected":"" }}>{{ $row->short_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="city" class="inline">City : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <select name="city" id="citiesRegForm" data-placeholder="Choose a city..."
                                                class="chosen-select">
                                            <option value=""></option>
                                            @if(isset($orgCities))
                                                @foreach($orgCities as $row)
                                                    <option value="{{ $row->id }}" {{ (isset($orgCity) && $orgCity == $row->id)?"selected":"" }}>{{ $row->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="org_url" class="inline">Organization Url : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <input type="url" id="org_url" name="org_url" value="{{$org->url}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="org_logo" class="inline">Organization Logo : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        {!! Form::file('org_logo', null, array('class' => 'inline','id' => 'org_logo')) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="org_application" class="inline">Application : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        {!! Form::file('org_application', null, array('class' => 'inline','id' => 'org_application')) !!}
                                    </div>
                                </div>
                            </div>
                            <h5>Administrator Settings</h5>
                            <div class="small-20 large-20 columns">
                                <div class="row">
                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_username" class="inline">Username : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_username" name="admin_username"
                                               placeholder="Username" value="<?php echo $org->username ?>">
                                    </div>

                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_address" class="inline">Address : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_address" name="admin_address"
                                               placeholder="Adress" value="<?php echo $org->address ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_name" class="inline">Admin Name : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_name" name="admin_name"
                                               placeholder="Admin Name" value="<?php echo $org->admin_name ?>">
                                    </div>

                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_program" class="inline">Degree/Program : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_program" name="admin_program"
                                               placeholder="Degree/Program" value="<?php echo $org->program ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_phone" class="inline">Phone : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_phone" name="admin_phone"
                                               placeholder="Admin Phone" value="<?php echo $org->mobile ?>">
                                    </div>

                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_email" class="inline">Email : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_email" name="admin_email"
                                               placeholder="Email" value="<?php echo $org->email ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                                    <input type="submit" class="small button radius" name="submit" value="Save">
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="addmember">
                    {!! Form::open(array('url' => 'organization/addmember','id' => 'add_member_form')) !!}
                    {!! Form::hidden('org_id', $org->id) !!}
                    <div class="row">
                        <div class="small-20 large-20 columns">
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('name', 'Name :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::text('name', Input::old('name'), array('class' => 'inline','id' => 'name','placeholder' => 'Name')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('username', 'Username :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 large-10 medium-10 columns left">
                                    {!! Form::text('username', Input::old('username'), array('class' => 'inline','id' => 'username','placeholder' => 'Username')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::email('email', Input::old('email'), array('class' => 'inline','id' => 'email','placeholder' => 'Email')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('password', 'Password :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::password('password', array('class' => 'inline','id' => 'password','placeholder' => 'Password')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('password_confirmation', 'Confirm Password :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::password('password_confirmation', array('class' => 'inline','id' => 'password_confirmation','placeholder' => 'Confirm Password')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('gender', 'Gender :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::select('gender', [
                                    '' => 'Select Your Gender',
                                    'Male' => 'Male',
                                    'Female' => 'Female']
                                    ) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('dob', 'Date Of Birth :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    <input type="text" id="datetimepicker" name="dob">
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('phone', 'Phone :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::text('phone', Input::old('phone'), array('class' => 'inline','id' => 'phone','placeholder' => 'Phone Number')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('mobile', 'Mobile# :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::text('mobile', Input::old('mobile'), array('class' => 'inline','id' => 'mobile','placeholder' => 'Mobile Number')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('address', 'Address :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::text('address', Input::old('address'), array('class' => 'inline','id' => 'address','placeholder' => 'Address')) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    {!! Form::select('city_id', [
                                    '' => 'Location/City',
                                    '208' => 'Lahore',
                                    '169' => 'Karachi',
                                    '130' => 'Islamabad',
                                    '1' => 'Abbotabad',
                                    '4' => 'Adda shaiwala',
                                    '9' => 'Arif wala',
                                    '10' => 'Arifwala',
                                    '13' => 'Badin',
                                    '15' => 'Bahawalpur',
                                    '18' => 'Barbar loi',
                                    '25' => 'Bhawal nagar',
                                    '26' => 'Bhera',
                                    '28' => 'Bhirya road',
                                    '30' => 'Bhurewala',
                                    '41' => 'Chakwal',
                                    '42' => 'Charsada',
                                    '68' => 'Dera ghazi khan',
                                    '76' => 'Dina',
                                    '85' => 'Faisalabad',
                                    '90' => 'Feteh jhang',
                                    '103' => 'Ghotki',
                                    '111' => 'Gujranwala',
                                    '112' => 'Gujrat',
                                    '118' => 'Haroonabad',
                                    '125' => 'Hayatabad',
                                    '129' => 'Hyderabad',
                                    '132' => 'Jaccobabad',
                                    '141' => 'Jaranwala',
                                    '147' => 'Jhang',
                                    '149' => 'Jhelum',
                                    '174' => 'Kasur',
                                    '176' => 'Khair pur',
                                    '181' => 'Khanewal',
                                    '186' => 'Khewra',
                                    '193' => 'Kot addu',
                                    '202' => 'Kotli loharan',
                                    '203' => 'Kotri',
                                    '227' => 'Mandi bahauddin',
                                    '232' => 'Mangla',
                                    '249' => 'Mirpur khas',
                                    '256' => 'Multan',
                                    '262' => 'Muzaffarabad',
                                    '266' => 'Narowal',
                                    '275' => 'Nowshera',
                                    '278' => 'Okara',
                                    '285' => 'Patoki',
                                    '286' => 'Peshawar',
                                    '302' => 'Rahimyar khan',
                                    '304' => 'Raiwand',
                                    '311' => 'Rawalpindi',
                                    '316' => 'Sadiqabad',
                                    '318' => 'Sahiwal',
                                    '332' => 'Sargodha',
                                    '341' => 'Shaikhupura',
                                    '350' => 'Sialkot',
                                    '358' => 'Sohawa district jelum',
                                    '365' => 'Talhur',
                                    '374' => 'Taxila',
                                    '381' => 'Topi',
                                    '391' => 'Vehari',
                                    '392' => 'Wah cantt']
                                    ) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="hide-for-small-only medium-7 large-5 columns">
                                    {!! Form::label('bgroup', 'Blood Group :' ,array('class' => 'inline')) !!}
                                </div>
                                <div class="small-20 medium-10 large-10 columns left">
                                    <label>
                                        {!! Form::select('bgroup', [
                                        '' => 'Select Your Blood Group',
                                        'Ap' => 'A+',
                                        'An' => 'A-',
                                        'Bp' => 'B+',
                                        'Bn' => 'B-',
                                        'Op' => 'O+',
                                        'On' => 'O-',
                                        'ABp' => 'AB+',
                                        'ABn' => 'AB-']
                                        ) !!}
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div id="submit_btn" class="small-20 medium-20 large-20 columns">
                                    <input type="submit" class="small button radius" name="submit" value="Register!">
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="viewmember">
                    <table width="100%">
                        <tr>
                            <th class="hide-for-small-up">#</th>
                            <th>Name</th>
                            <th class="hide-for-small-up">Email</th>
                            <th>Contact</th>
                            <th class="hide-for-small-up">Address</th>
                            <th>Options</th>
                        </tr>
                        <?php $ucount = 1; ?>
                        @foreach($users as $user)
                            <tr>
                                <td class="hide-for-small-up">{{$ucount}}</td>
                                <td>{{$user->name}}</td>
                                <td class="hide-for-small-up">{{$user->email}}</td>
                                <td>{{$user->phone}} {{$user->mobile}}</td>
                                <td class="hide-for-small-up">{{$user->address}}</td>
                                <td>
                                    <a href="{{url('/profile/'.$user->username)}}">View |</a>
                                    <a href="{{url('/profile/'.$user->username.'#fndtn-editprofile')}}"> Edit |</a>
                                    <a data-confirm href="{{url('/delete/user/'.$user->id)}}"> Delete</a>
                                </td>
                            </tr>
                            <?php $ucount += 1; ?>
                        @endforeach
                    </table>
                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="viewrequests">
                    <table width="100%">
                        <tr>
                            <th class="hide-for-small-up">#</th>
                            <th>Name</th>
                            <th class="hide-for-small-up">Email</th>
                            <th>Contact</th>
                            <th>Blood Group</th>
                            <th class="hide-for-small-up">Message</th>
                            <th>Options</th>
                        </tr>
                        <?php $rcount = 1; ?>
                        @foreach($reqs as $req)
                            <tr>
                                <td class="hide-for-small-up">{{$rcount}}</td>
                                <td>{{$req->name}}</td>
                                <td class="hide-for-small-up">{{$req->email}}</td>
                                <td>{{$req->phone}},{{$req->mobile}}</td>
                                <td>{{$req->blood_group}}</td>
                                <td class="hide-for-small-up">{{$req->reason}}</td>
                                <td>
                                    {{--<a href="{{url('/profile/'.$user->username)}}">View</a> | --}}
                                    <a href="{{url('/organization/request/accept/'.$req->req_id)}}">Approve</a> |
                                    <a href="{{url('/organization/request/reject/'.$req->req_id)}}">Disapprove</a>
                                </td>
                            </tr>
                            <?php $rcount += 1;?>
                        @endforeach
                    </table>
                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="adminsettings">
                    <div class="row">
                        {!! Form::open(array('url' => '/organization/change/admin','data-confirm' =>'Are You sure you want transfer ownership of your organization?','id' => 'add_member_form')) !!}
                        {!! Form::hidden('org_id',$org->id) !!}
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('new_owner', 'Change Organization Owner :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <select id="new_owner" name="new_owner">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                                <input type="submit" class="small button radius" name="submit" value="Confirm!">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="deleteorganization">
                    <div class="row">
                        <div class="row">
                            {!! Form::open(array('url' => 'delete/organization','id' => 'add_member_form' ,'data-confirm' => ''))!!}
                            {!! Form::hidden('org_id', Auth::user()->org_id) !!}
                            <h5 style="text-align: center;">Delete Organization</h5>
                            <div class="row">
                                <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                                    <p style="text-align: center;border:none;">
                                        Are you sure you want to delete your organization?</br>
                                        If you are sure, click Delete button given below.</br></br>
                                        Thanks for becoming a part of PAKBLOOD.</br></br>
                                        PAKBLOOD TEAM
                                    </p>
                                </div>
                            </div>
                            <div style="text-align: center;" class="small-20 medium-20 large-20 columns">
                                <input type="submit" class="small button radius" value="Delete">
                            </div>
                            {!! Form::close() !!}
                        </div>
                </section>
            </div>
        @endif
    @endif
</div>
<script>
    //ID of select containing countries and ID of select containing cities.
    countryAndCitySelect('countriesRegForm', 'citiesRegForm');
    $(document).on('change', '#tabSelect', function () {
        //        console.log($(this));
        //        console.log($(this).val());
        $('.tabs-content#add_member').find('section.active').removeClass('active');
        $('.tabs-content#add_member').find('section' + $(this).val()).addClass('active');
    });
</script>
@include('footer')