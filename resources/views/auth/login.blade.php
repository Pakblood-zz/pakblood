@include('header')
@include('search_bar')
<!-- Center Container-->
<div class="row center-container">
    <div id="login" class="row">
        <div>
            {!! Form::open(array('url' => 'auth/login','class' => 'small-20 medium-10 large-8 columns','style' => 'margin: auto 30%;')) !!}
            <h5>Donor Login</h5>
            @if (count($errors) > 0)
                <div class="row">
                    @foreach ($errors->all() as $error)
                        <small class="error small-20 medium-14 large-20 columns">{{ $error }}</small>
                    @endforeach
                </div>
            @endif
            @if(Session::get('message') != NULL)
                @if((Session::has('type')) && (Session::get('type')=='success'))
                    <div data-alert class="alert-box success radius   small-20 medium-14 large-20 columns" style="text-align: center;font-weight: bold;">
                    {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
                @if((Session::has('type')) && (Session::get('type')=='error'))
                    <div data-alert class="alert-box alert radius  error small-20 medium-14 large-20 columns" style="text-align: center;font-weight: bold;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
                @if((Session::has('type')) && (Session::get('type')=='deactivated'))
                    <div data-alert class="alert-box alert radius  error small-20 medium-14 large-20 columns" style="text-align: center;font-weight: bold;">
                        <span>Your Account has been deactivated. Follow this <a href="{{url('/account/activation')}}">Link</a> to activate your account</span>
                    </div>
                @endif
            @endif
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
                    {!! Form::label('pass', 'Password :',array('class' => 'inline')) !!}
                </div>
                <div class="small-20 medium-14 large-14 columns left">
                    {!! Form::password('password', array('class' => 'inline','id' => 'pass','placeholder' => 'Password')) !!}
                </div>
            </div>
            <div class="login_btn small-20 medium-14 large-15 columns">
                <input type="submit" class="small button radius" name="submit" value="Login">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('footer')