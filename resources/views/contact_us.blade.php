@include('header')
@include('search_bar')
        <!-- Center Container-->
<div class="row center-container">
    <div data-alert class="alert-box info radius">
        Pakblood is not a blood bank and can not entertain any messages which says
        "HELP we need blood". We only have blood donors list and if the blood group you need is not in the search
        result,
        we dont have that blood group.
    </div>
    <div class="row">
        {!! Form::open(['url' => '/contact','class' => 'small-20 medium-15 large-15 columns small-centered','id'=>'contact_form']) !!}
        <h5 style="color: red;">Contact Us</h5>
        @if (count($errors) > 0)
            <div class="row">
                @foreach ($errors->all() as $error)
                    <small class="error small-20 medium-14 large-20 columns">{{ $error }}</small>
                @endforeach
            </div>
        @endif
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
        <div class="row">
            <div class="hide-for-small-only medium-6 large-6 columns">
                {!! Form::label('name', 'Name :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-14 large-14 columns left">
                {!! Form::text('name', Input::old('name'), array('class' => 'inline','id' => 'name','placeholder' => 'Name')) !!}
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-6 large-6 columns">
                {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-14 large-14 columns left">
                {!! Form::email('email', Input::old('email'), array('class' => 'inline','id' => 'email','placeholder' => 'Email')) !!}
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-6 large-6 columns">
                {!! Form::label('subject', 'Subject :',array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-14 large-14 columns left">
                {!! Form::text('subject', Input::old('subject'),array('class' => 'inline','id' => 'subject','placeholder' => 'Subject ')) !!}
            </div>
        </div>

        <div class="row">
            <div class="hide-for-small-only medium-6 large-6 columns">
                {!! Form::label('country', 'Country :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-14 large-14 columns left">
                <select name="country" id="countriesRegForm" data-placeholder="Choose a country..."
                        class="chosen-select">
                    <option value=""></option>
                    @foreach($countries as $row)
                        <option value="{{ $row->id }}" {{ (Input::old('country') == $row->id)?"selected":"" }}>{{ $row->short_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-6 large-6 columns">
                {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-14 large-14 columns left">
                <select name="city" id="citiesRegForm" data-placeholder="Choose a city..."
                        class="chosen-select" {{ (isset($city))?"":"disabled" }}>
                    <option value=""></option>
                    @if(isset($cities))
                        @foreach($cities as $row)
                            <option value="{{ $row->id }}" {{ (isset($city) && $city== $row->id)?"selected":"" }}>{{ $row->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-6 large-6 columns">
                {!! Form::label('message', 'Message :',array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-14 large-14 columns left">
                {!! Form::textarea('message', NULL, ['size' => '30x5']) !!}
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-6 large-6 columns">
                {!! Form::label('captcha', 'Captcha :',array('class' => 'inline')) !!}
            </div>
            <div style="margin-top: 10px;" class="small-20 medium-14 large-14 columns right">
                {!! app('captcha')->display() !!}
            </div>
        </div>
        <div style="text-align: center;margin-top: 10px;" class="login_btn small-20 medium-20 large-20 columns">
            <input type="submit" class="small button radius" name="submit" value="Submit">
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    //ID of select containing countries and ID of select containing cities.
    countryAndCitySelect('countriesRegForm', 'citiesRegForm');
</script>
@include('footer')