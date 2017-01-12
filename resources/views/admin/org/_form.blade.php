<div class="row">
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
                {!! Form::label('address', 'Organization Address :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 large-10 medium-10 columns left">
                {!! Form::text('address', Input::old('address'), array('class' => 'inline','id' => 'address','placeholder' => 'Organization Address')) !!}
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-5 columns">
                {!! Form::label('phone', 'Organization Phone :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                {!! Form::text('phone', Input::old('phone'), array('class' => 'inline','id' => 'phone','placeholder' => 'Organization Phone')) !!}
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
                {!! Form::label('url', 'Organization Url :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                {!! Form::url('url', Input::old('url'), array('class' => 'inline','id' => 'url','placeholder' => 'Organization Url')) !!}
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-5 columns">
                {!! Form::label('image', 'Organization Logo :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                {{--{!! Form::file('logo', NULL, array('class' => 'inline','id' => 'logo')) !!}--}}
                <div class="row">
                    <div class="small-20 medium-10 large-10 columns">
                        <input class="inline" id="image" name="image" onchange="imagePreview(this)"
                               type="file">
                        {{--{!! Form::file('profile_image', array('class' => 'inline','id' => 'profile_image','onchange'=>'imagePreview()')) !!}--}}
                    </div>
                    <div class="small-20 medium-10 large-10 columns text-center">
                        <div id="image_preview" style="margin-bottom: 20px;">
                            @if(isset($org) && $org->image != null)
                                {!! HTML::image('images/logos/'.$org->image,'Organization Logo',['style'=>'width: 200px;height: auto;']) !!}
                            @else
                                {!! HTML::image('images/logos/default.png','Organization Logo',['style'=>'width: 200px;height: auto;']) !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5>Administrator Settings</h5>
    <div class="small-20 large-20 columns">
        <div class="row">
            <div class="hide-for-small-only hide-for-medium-only medium-7 large-3 columns">
                {!! Form::label('user_id', 'User :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-7 columns left">
                {{--{!! Form::text('username', Input::old('username'), array('class' => 'inline','id' => 'username','placeholder' => 'Username')) !!}--}}
                <label>
                    <select name="user_id" id="user_id" data-placeholder="Choose a user..."
                            class="chosen-select">
                        <option value=""></option>
                        @if(isset($users))
                            @foreach($users as $row)
                                <option value="{{ $row->id }}" {{ (isset($user) && $user->id== $row->id)?"selected":"" }}>{{ $row->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </label>
            </div>
            <div class="hide-for-small-only hide-for-medium-only medium-7 large-3 columns">
                {!! Form::label('admin_name', 'Name :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-7 columns left">
                {!! Form::text('admin_name', Input::old('admin_name'), array('class' => 'inline','readOnly' => true,'id' => 'admin_name','placeholder' => 'Admin Name ')) !!}
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only hide-for-medium-only medium-7 large-3 columns">
                {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-7 columns left">
                {!! Form::text('email', Input::old('email'), array('class' => 'inline','readOnly' => true,'id' => 'email','placeholder' => 'Email ')) !!}
            </div>
            <div class="hide-for-small-only hide-for-medium-only medium-7 large-3 columns">
                {!! Form::label('username', 'Username :' ,array('class' => 'inline')) !!}
            </div>
            <div class="small-20 medium-10 large-7 columns left">
                {!! Form::text('username', Input::old('username'), array('class' => 'inline','readOnly' => true,'id' => 'username','placeholder' => 'Username')) !!}
            </div>
        </div>
        {{--
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
            <a href="{{\URL::previous()}}" class="small button alert radius" name="cancel">Cancel</a>
            <input type="submit" class="small button radius" name="submit" value="{{$submitButtonText}}">
            @if($submitButtonText == 'Update')
                <a data-confirm href="{{url('/admin/organization/'.$org->id.'/delete')}}"
                   class="small button radius secondary">Delete </a>
            @endif
        </div>
    </div>
</div>
<script>
    countryAndCitySelect('countries', 'cities', true);
    usersSelect('user_id');
</script>