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
<div class="row center-container">
    <div id="login" class="row">
        <div>
            @if(Session::has('status'))
                <small class="alert-box info radius  small-20 medium-14 large-20 columns" style="text-align: center;">{{ Session::get('status') }}</small>
            @endif
            {!! Form::open(array('url' => '/password/email','class' => 'small-20 medium-10 large-8 columns','style' => 'margin: auto 30%;')) !!}
            <h5>Forgot Password</h5>
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
            <div class="login_btn small-20 medium-14 large-15 columns">
                <input type="submit" class="small button radius" name="submit" value="Rest Password">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('footer')