@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row">
            <h3 class="page_heading">Add Organization </h3>
            <div class="bg_icon">
                <li class="fi-torsos-all size-72"></li>
            </div>
        </div>
        <a class="small button" style="border-radius: 50px 5px 5px 50px;" href="{{url('/admin/organization')}}">Go
            back</a>
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
            @if (count($errors) > 0)
                <div>
                    @foreach ($errors->all() as $error)
                        <small class="error">{{ $error }}</small>
                    @endforeach
                </div>
            @endif
            {!! Form::open(array('url' => '/admin/add/organization','enctype' => 'multipart/form-data')) !!}
            <h5>Organization/institute information</h5>
            <div class="small-20 large-20 columns">
                <div class="row">
                    <div class="hide-for-small-only medium-7 large-5 columns">
                        {!! Form::label('name', 'Organization Name :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-10 columns left">
                        {!! Form::text('name', Input::old('name'), array('class' => 'inline','id' => 'name','placeholder' => 'Organization Name')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="hide-for-small-only medium-7 large-5 columns">
                        {!! Form::label('org_address', 'Organization Address :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 large-10 medium-10 columns left">
                        {!! Form::text('org_address', Input::old('org_address'), array('class' => 'inline','id' => 'org_address','placeholder' => 'Organization Address')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="hide-for-small-only medium-7 large-5 columns">
                        {!! Form::label('org_phone', 'Organization Phone :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-10 columns left">
                        {!! Form::text('org_phone', Input::old('org_phone'), array('class' => 'inline','id' => 'org_phone','placeholder' => 'Organization Phone')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="hide-for-small-only medium-7 large-5 columns">
                        {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-10 columns left">
                        <label>
                            <select id="city" name="city">
                                <option value="">Select City</option>
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
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="hide-for-small-only medium-7 large-5 columns">
                        {!! Form::label('url', 'Organization Url :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-10 columns left">
                        {!! Form::url('url', Input::old('url'), array('class' => 'inline','id' => 'url','placeholder' => 'Organization Url')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="hide-for-small-only medium-7 large-5 columns">
                        {!! Form::label('logo', 'Organization Logo :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-10 columns left">
                        {!! Form::file('logo', NULL, array('class' => 'inline','id' => 'logo')) !!}
                    </div>
                </div>
            </div>
            <h5>Administrator Settings</h5>
            <div class="small-20 large-20 columns">
                <div class="row">
                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                        {!! Form::label('username', 'Username :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-6 columns left">
                        {!! Form::text('username', Input::old('username'), array('class' => 'inline','id' => 'username','placeholder' => 'Username')) !!}
                    </div>
                    {{-- <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                         {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                     </div>
                     <div class="small-20 medium-10 large-6 columns left">
                         {!! Form::text('email', Input::old('email'), array('class' => 'inline','id' => 'email','placeholder' => 'Email ')) !!}
                     </div>--}}
                </div>
                {{--<div class="row">
                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                        {!! Form::label('admin_name', 'Name :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-6 columns left">
                        {!! Form::text('admin_name', Input::old('admin_name'), array('class' => 'inline','id' => 'admin_name','placeholder' => 'Name ')) !!}
                    </div>
                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                        {!! Form::label('admin_program', 'Degree/Program :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-6 columns left">
                        {!! Form::text('admin_program', Input::old('admin_program'), array('class' => 'inline','id' => 'admin_program','placeholder' => 'Degree/Program ')) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                        {!! Form::label('admin_phone', 'Phone :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-6 columns left">
                        {!! Form::text('admin_phone', Input::old('admin_phone'), array('class' => 'inline','id' => 'admin_phone','placeholder' => 'Phone ')) !!}
                    </div>
                    <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                        {!! Form::label('admin_address', 'Address :' ,array('class' => 'inline')) !!}
                    </div>
                    <div class="small-20 medium-10 large-6 columns left">
                        {!! Form::text('admin_address', Input::old('admin_address'), array('class' => 'inline','id' => 'admin_address','placeholder' => 'Address ')) !!}
                    </div>
                </div>--}}
                <div class="row" style="text-align:center;">
                    <input type="submit" class="small button radius" name="submit" value="Submit">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>

@include('admin.footer')