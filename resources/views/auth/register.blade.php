@include('header')
<!-- Search area -->
@include('search_bar')
<!-- Center Container-->
<div class="row center-container">
    <!-- left container -->
    <div id="left-container" class="small-20 medium-14 large-14 columns">
        <div id="add_member">
            @if(Auth::user()))
            <div id="add_member_nav">
                <a href="#">Main </a>
                <a href="#">Add Donor </a>
                <a href="#">Edit Profile </a>
                <a href="#">Edit Login </a>
                <a href="#">Search</a>
            </div>
            @endif
            <div id="add_member_heading">
                <h5>Donor Registration</h5>
                <p>Please don't create fake profiles, because you don't want to play with the life of a person.
                    Donor Information</p>
                @if (count($errors) > 0)
                    <div>
                        @foreach ($errors->all() as $error)
                            <small class="error">{{ $error }}</small>
                        @endforeach
                    </div>
                @endif
            </div>
            <div>
                {!! Form::open(array('url' => 'auth/register','id' => 'add_member_form')) !!}
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
            </div>
        </div>
    </div>
    <!-- right container -->
    <div id="right-container" class="small-20 medium-6 large-6 columns">
        <div id="promote-pakblood" class="row">
            <h5>Promote Pakblood</h5>

            <p>Use the images below on your Skype, MSN, Yahoo and Facebook etc. to promote a nobel cause and to display what
                type of blood you have. </p>
            <div class="promotion-imges">
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
            </div>
        </div>
        <div id="latest-updates" class="row">
            <h5 id="heading">Latest Updates</h5>
            <p>
                We are proude to inform all of our users that we are
                now available on twitter. We also have connected t
                he blood query / wish part to the twitter. On every
                single request coming to our website will be
                redirected to our twitter profile. Please do follow
                us on twitter. Thank you...</p>
            <div class="btn">
                <a href="#" class="secondary button radius"><span>Read More</span></a>
            </div>
            <h5 class="inner-heading"><a href="#">Blood Donors Organizations & Institutes</a></h5>

            <p>
                Thank you all for waiting so long. We have started
                work on Pakblood again. In past we have lost our
                concentration due to lack of time and pressure from
                other projects going on. But believe me, PAKB...
            </p>

            <div class="btn">
                <a href="#" class="button radius"><span>View All</span></a>
            </div>
        </div>
    </div>
</div>
@include('footer')