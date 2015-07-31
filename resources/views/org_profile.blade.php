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
    {{-- If user is registered but have not joined or created any organization yet --}}
    @if(!Auth::guest() && (Auth::user()->org_id == 0 || Auth::user()->id != $org->user_id))
        <div @if(Auth::user()->org_id == 0) class="large-10 left" @else class="org_profile" @endif >
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
            <ul class="tabs" data-tab role="tablist" data-options="deep_linking:true;scroll_to_content: false">
                <li class="tab-title active" role="presentation"><a href="#main" role="tab" tabindex="0" aria-selected="true" aria-controls="main">Main </a></li>
                <li class="tab-title" role="presentation"><a href="#editprofile" role="tab" tabindex="0" aria-selected="false" aria-controls="editprofile">Edit Profile </a></li>
                <li class="tab-title" role="presentation"><a href="#addmember" role="tab" tabindex="0" aria-selected="false" aria-controls="addmember">Add Member </a></li>
                <li class="tab-title" role="presentation"><a href="#viewmember" role="tab" tabindex="0" aria-selected="false" aria-controls="viewmember">View Member </a></li>
                <li class="tab-title" role="presentation"><a href="#viewrequests" role="tab" tabindex="0" aria-selected="false" aria-controls="viewrequests">View Requests  </a></li>
                <li class="tab-title" role="presentation"><a href="#adminsettings" role="tab" tabindex="0" aria-selected="false" aria-controls="adminsettings">Admin Settings </a></li>
            </ul>
            <div id="add_member" class="tabs-content">
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
                                        <input class="inline"  id="org_name" placeholder="Organization Name" name="org_name" type="text" value="<?php echo $org->name?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        {!! Form::label('org_address', 'Organization Address :' ,array('class' => 'inline')) !!}
                                    </div>
                                    <div class="small-20 large-10 medium-10 columns left">
                                        <input class="inline"  id="org_address" placeholder="Organization Address" name="org_address" type="text" value="<?php echo $org->address?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        {!! Form::label('org_phone', 'Organization Phone :' ,array('class' => 'inline')) !!}
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <input class="inline"  id="org_phone" placeholder="Organization Phone" name="org_phone" type="text" value="<?php echo $org->phone?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="city" class="inline">City : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <select id="city"  name="city_id">
                                            <option value="208"<?php if(($org->city_id)== '208') echo 'selected="selected"'; ?>>Lahore</option>
                                            <option value="169"<?php if(($org->city_id)== '169') echo 'selected="selected"'; ?>>Karachi</option>
                                            <option value="130"<?php if(($org->city_id)== '130') echo 'selected="selected"'; ?>>Islamabad</option>
                                            <option value="1"<?php if(($org->city_id)== '1') echo 'selected="selected"'; ?>>Abbotabad</option>
                                            <option value="4"<?php if(($org->city_id)== '4') echo 'selected="selected"'; ?>>Adda shaiwala</option>
                                            <option value="9"<?php if(($org->city_id)== '9') echo 'selected="selected"'; ?>>Arif wala</option>
                                            <option value="10"<?php if(($org->city_id)== '10') echo 'selected="selected"'; ?>>Arifwala</option>
                                            <option value="13"<?php if(($org->city_id)== '13') echo 'selected="selected"'; ?>>Badin</option>
                                            <option value="15"<?php if(($org->city_id)== '15') echo 'selected="selected"'; ?>>Bahawalpur</option>
                                            <option value="18"<?php if(($org->city_id)== '18') echo 'selected="selected"'; ?>>Barbar loi</option>
                                            <option value="25"<?php if(($org->city_id)== '25') echo 'selected="selected"'; ?>>Bhawal nagar</option>
                                            <option value="26"<?php if(($org->city_id)== '26') echo 'selected="selected"'; ?>>Bhera</option>
                                            <option value="28"<?php if(($org->city_id)== '28') echo 'selected="selected"'; ?>>Bhirya road</option>
                                            <option value="30"<?php if(($org->city_id)== '30') echo 'selected="selected"'; ?>>Bhurewala</option>
                                            <option value="41"<?php if(($org->city_id)== '41') echo 'selected="selected"'; ?>>Chakwal</option>
                                            <option value="42"<?php if(($org->city_id)== '42') echo 'selected="selected"'; ?>>Charsada</option>
                                            <option value="68"<?php if(($org->city_id)== '68') echo 'selected="selected"'; ?>>Dera ghazi khan</option>
                                            <option value="76"<?php if(($org->city_id)== '76') echo 'selected="selected"'; ?>>Dina</option>
                                            <option value="85"<?php if(($org->city_id)== '85') echo 'selected="selected"'; ?>>Faisalabad</option>
                                            <option value="90"<?php if(($org->city_id)== '90') echo 'selected="selected"'; ?>>Feteh jhang</option>
                                            <option value="103"<?php if(($org->city_id)== '103') echo 'selected="selected"'; ?>>Ghotki</option>
                                            <option value="111"<?php if(($org->city_id)== '111') echo 'selected="selected"'; ?>>Gujranwala</option>
                                            <option value="112"<?php if(($org->city_id)== '112') echo 'selected="selected"'; ?>>Gujrat</option>
                                            <option value="118"<?php if(($org->city_id)== '118') echo 'selected="selected"'; ?>>Haroonabad</option>
                                            <option value="125"<?php if(($org->city_id)== '125') echo 'selected="selected"'; ?>>Hayatabad</option>
                                            <option value="129"<?php if(($org->city_id)== '129') echo 'selected="selected"'; ?>>Hyderabad</option>
                                            <option value="132"<?php if(($org->city_id)== '132') echo 'selected="selected"'; ?>>Jaccobabad</option>
                                            <option value="141"<?php if(($org->city_id)== '141') echo 'selected="selected"'; ?>>Jaranwala</option>
                                            <option value="147"<?php if(($org->city_id)== '147') echo 'selected="selected"'; ?>>Jhang</option>
                                            <option value="149"<?php if(($org->city_id)== '149') echo 'selected="selected"'; ?>>Jhelum</option>
                                            <option value="174"<?php if(($org->city_id)== '174') echo 'selected="selected"'; ?>>Kasur</option>
                                            <option value="176"<?php if(($org->city_id)== '176') echo 'selected="selected"'; ?>>Khair pur</option>
                                            <option value="181"<?php if(($org->city_id)== '181') echo 'selected="selected"'; ?>>Khanewal</option>
                                            <option value="186"<?php if(($org->city_id)== '186') echo 'selected="selected"'; ?>>Khewra</option>
                                            <option value="193"<?php if(($org->city_id)== '193') echo 'selected="selected"'; ?>>Kot addu</option>
                                            <option value="202"<?php if(($org->city_id)== '202') echo 'selected="selected"'; ?>>Kotli loharan</option>
                                            <option value="203"<?php if(($org->city_id)== '203') echo 'selected="selected"'; ?>>Kotri</option>
                                            <option value="227"<?php if(($org->city_id)== '227') echo 'selected="selected"'; ?>>Mandi bahauddin</option>
                                            <option value="232"<?php if(($org->city_id)== '232') echo 'selected="selected"'; ?>>Mangla</option>
                                            <option value="249"<?php if(($org->city_id)== '249') echo 'selected="selected"'; ?>>Mirpur khas</option>
                                            <option value="256"<?php if(($org->city_id)== '256') echo 'selected="selected"'; ?>>Multan</option>
                                            <option value="262"<?php if(($org->city_id)== '262') echo 'selected="selected"'; ?>>Muzaffarabad</option>
                                            <option value="266"<?php if(($org->city_id)== '266') echo 'selected="selected"'; ?>>Narowal</option>
                                            <option value="275"<?php if(($org->city_id)== '275') echo 'selected="selected"'; ?>>Nowshera</option>
                                            <option value="278"<?php if(($org->city_id)== '278') echo 'selected="selected"'; ?>>Okara</option>
                                            <option value="285"<?php if(($org->city_id)== '285') echo 'selected="selected"'; ?>>Patoki</option>
                                            <option value="286"<?php if(($org->city_id)== '286') echo 'selected="selected"'; ?>>Peshawar</option>
                                            <option value="302"<?php if(($org->city_id)== '302') echo 'selected="selected"'; ?>>Rahimyar khan</option>
                                            <option value="304"<?php if(($org->city_id)== '304') echo 'selected="selected"'; ?>>Raiwand</option>
                                            <option value="311"<?php if(($org->city_id)== '311') echo 'selected="selected"'; ?>>Rawalpindi</option>
                                            <option value="316"<?php if(($org->city_id)== '316') echo 'selected="selected"'; ?>>Sadiqabad</option>
                                            <option value="318"<?php if(($org->city_id)== '318') echo 'selected="selected"'; ?>>Sahiwal</option>
                                            <option value="332"<?php if(($org->city_id)== '332') echo 'selected="selected"'; ?>>Sargodha</option>
                                            <option value="341"<?php if(($org->city_id)== '341') echo 'selected="selected"'; ?>>Shaikhupura</option>
                                            <option value="350"<?php if(($org->city_id)== '350') echo 'selected="selected"'; ?>>Sialkot</option>
                                            <option value="358"<?php if(($org->city_id)== '358') echo 'selected="selected"'; ?>>Sohawa district jelum</option>
                                            <option value="365"<?php if(($org->city_id)== '365') echo 'selected="selected"'; ?>>Talhur</option>
                                            <option value="374"<?php if(($org->city_id)== '374') echo 'selected="selected"'; ?>>Taxila</option>
                                            <option value="381"<?php if(($org->city_id)== '381') echo 'selected="selected"'; ?>>Topi</option>
                                            <option value="391"<?php if(($org->city_id)== '391') echo 'selected="selected"'; ?>>Vehari</option>
                                            <option value="392"<?php if(($org->city_id)== '392') echo 'selected="selected"'; ?>>Wah cantt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="org_url" class="inline">Organization Url : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <input type="url"  id="org_url" name="org_url" value="{{$org->url}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="org_logo" class="inline">Organization Logo : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <input type="file"  id="org_logo">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only medium-7 large-5 columns">
                                        <label for="org_application" class="inline">Application : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-10 columns left">
                                        <input type="file"  id="org_application" name="org_application">
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
                                        <input type="text" readonly id="admin_username" name="admin_username" placeholder="Username" value="<?php echo $org->username ?>">
                                    </div>

                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_address" class="inline">Address : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_address" name="admin_address" placeholder="Adress" value="<?php echo $org->address ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_name" class="inline">Admin Name : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_name" name="admin_name" placeholder="Admin Name" value="<?php echo $org->admin_name ?>">
                                    </div>

                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_program" class="inline">Degree/Program : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_program" name="admin_program" placeholder="Degree/Program" value="<?php echo $org->program ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_phone" class="inline">Phone : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_phone" name="admin_phone" placeholder="Admin Phone" value="<?php echo $org->mobile ?>">
                                    </div>

                                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                                        <label for="admin_email" class="inline">Email : </label>
                                    </div>
                                    <div class="small-20 medium-10 large-6 columns left">
                                        <input type="text" readonly id="admin_email" name="admin_email" placeholder="Email" value="<?php echo $org->email ?>">
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
                                    <input style="vertical-align: baseline;" type="date" id="dob" name="dob">
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
                                    {!! Form::select('bgroup', [
                                    '' => 'Select Your Blood Group',
                                    'A+' => 'A+',
                                    'A-' => 'A-',
                                    'B+' => 'B+',
                                    'B-' => 'B-',
                                    'O+' => 'O+',
                                    'O-' => 'O-',
                                    'AB+' => 'AB+',
                                    'AB-' => 'AB-']
                                    ) !!}
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
                            <th>#</th>
                            <th>Member Name </th>
                            <th>Email </th>
                            <th>Contact Number </th>
                            <th>Address </th>
                            <th>Options </th>
                        </tr>
                        <?php $ucount =1; ?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$ucount}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}} {{$user->mobile}}</td>
                                <td>{{$user->address}}</td>
                                <td><a href="{{url('/profile/'.$user->username)}}">View</a> | <a href="{{url('/profile/'.$user->username.'#fndtn-editprofile')}}">Edit</a> | <a data-confirm href="{{url('/delete/user/'.$user->id)}}">Delete</a></td>
                            </tr>
                            <?php $ucount += 1; ?>
                        @endforeach
                    </table>
                </section>
                <section role="tabpanel" aria-hidden="true" class="content" id="viewrequests">
                    @if(count($reqs) == 0) <span>You dont have any request</span>@endif
                    <table width="100%">
                        <tr>
                            <th>#</th>
                            <th>Name </th>
                            <th>Email </th>
                            <th>Contact Information </th>
                            <th>Blood Group </th>
                            <th>Message </th>
                            <th>Options </th>
                        </tr>
                        <?php $rcount =1; ?>
                        @foreach($reqs as $req)
                            <tr>
                                <td>{{$rcount}}</td>
                                <td>{{$req->name}}</td>
                                <td>{{$req->email}}</td>
                                <td>{{$req->phone}},{{$req->mobile}}</td>
                                <td>{{$req->blood_group}}</td>
                                <td>{{$req->reason}}</td>
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
            </div>
        @endif
    @endif
</div>
@include('footer')