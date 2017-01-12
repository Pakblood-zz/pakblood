<div class="row">
    <div class="small-20 large-20 columns">
        <div class="row">
            <div class="hide-for-small-only medium-7 large-5 columns">
                {!! Form::label('profile_image', 'Profile Image :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <div class="row">
                    <div class="small-20 medium-10 large-10 columns">
                        <input class="inline" id="profile_image" name="profile_image" onchange="imagePreview(this)"
                               type="file">
                        {{--{!! Form::file('profile_image', array('class' => 'inline','id' => 'profile_image','onchange'=>'imagePreview()')) !!}--}}
                    </div>
                    <div class="small-20 medium-10 large-10 columns text-center">
                        <div id="image_preview" style="margin-bottom: 20px;">
                            @if(isset($user) && $user->profile_image != null)
                                {!! HTML::image('images/users/'.$user->profile_image,'Profile Image',['style'=>'width: 100px;height: auto;']) !!}
                            @else
                                {!! HTML::image('images/users/default.jpg','Profile Image',['style'=>'width: 100px;height: auto;']) !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                {!! Form::label('country', 'Country :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <label>
                    <select name="country" id="countries" data-placeholder="Choose a Country..."
                            class="chosen-select">
                        <option value=""></option>
                        @foreach($countries as $row)
                            <option value="{{ $row->id }}" {{ (isset($city) && $city->country_id == $row->id)?"selected":"" }}>{{ $row->short_name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-5 columns">
                {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <label>
                    <select name="city_id" id="cities" data-placeholder="Choose a City..."
                            class="chosen-select" {{ (isset($city))?"":"disabled" }}>
                        <option value=""></option>
                        @if(isset($cities))
                            @foreach($cities as $row)
                                <option value="{{ $row->id }}" {{ (isset($city) && $city->id== $row->id)?"selected":"" }}>{{ $row->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-5 columns">
                {!! Form::label('bgroup', 'Blood Group :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <label>
                    {!! Form::select('blood_group', [
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
        </div>--}}
        <div class="row">
            <div class="hide-for-small-only medium-7 large-5 columns">
                {!! Form::label('org', 'Organization :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <select name="org_id" id="org_id" data-placeholder="Choose an Organization..."
                        class="chosen-select">
                    <option value=""></option>
                    @if(isset($organizations))
                        @foreach($organizations as $row)
                            <option value="{{ $row->id }}" {{ (isset($user) && $user->org_id== $row->id)?"selected":"" }}>{{ ucfirst($row->name) }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
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
            <div class="hide-for-small-only medium-7 large-5 columns">
                {!! Form::label('status', 'User Role :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <label>
                    {!! Form::select('role', [
                    'user' => 'User',
                    'admin' => 'Admin']) !!}
                </label>
            </div>
        </div>
        <div class="row">
            <div id="submit_btn" class="small-20 medium-20 large-20 columns text-center">
                <a href="{{\URL::previous()}}" class="small button alert radius" name="cancel">Cancel</a>
                <input type="submit" class="small button radius" name="submit" value="{{$submitButtonText}}">
            </div>
        </div>
    </div>
</div>
<script>
    countryAndCitySelect('countries', 'cities', true);
    $('#org_id').select2({
        width: "100%",
        allowClear: true
    });
</script>