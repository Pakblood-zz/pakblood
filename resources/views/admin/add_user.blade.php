@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">Add User </h3><div class="bg_icon"><li class="fi-torso size-72"></li></div></div>
        <a class="small button" style="border-radius: 50px 5px 5px 50px;" href="{{url('/admin/organiztions')}}">Go back</a>
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
            @if (count($errors) > 0)
                <div>
                    @foreach ($errors->all() as $error)
                        <small class="error">{{ $error }}</small>
                    @endforeach
                </div>
            @endif
            {!! Form::open(array('url' => 'admin/add/user')) !!}
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
                            {!! Form::text('email', Input::old('email'), array('class' => 'inline','id' => 'email','placeholder' => 'Email')) !!}
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
                            <label>
                                {!! Form::select('gender', [
                                '' => 'Select Your Gender',
                                'Male' => 'Male',
                                'Female' => 'Female']
                                ) !!}
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('dob', 'Date Of Birth :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::text('dob', Input::old('dob'), array('class' => 'inline datetimepicker','id' => 'dob','placeholder' => 'Date Of Birth')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('phone', 'Phone :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::text('phone', Input::old('phone'), array('class' => 'inline','id' => 'dob','placeholder' => 'Phone Number')) !!}
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
                            {!! Form::text('address', Input::old('address'), array('class' => 'inline','id' => 'address','placeholder' => 'Address ')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <label>
                                {!! Form::select('city', [
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
                            </label>
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
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'O+' => 'O+',
                                'O-' => 'O-',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-']
                                ) !!}
                            </label>
                        </div>
                    </div>
                    {{--<div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('last_bleed', 'Last Bleed :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input type="text" id="last_bleed" class="datetimepicker" name="last_bleed">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('org', 'Organization :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <input type="text" id="org" name="org">
                        </div>
                    </div>--}}
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('status', 'Account Status :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <label>
                                {!! Form::select('status', [
                                '' => 'Select Account Status',
                                'active' => 'Active',
                                'inactive' => 'Inactive']) !!}
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
        </div>
    </div>
</section>

@include('admin.footer')