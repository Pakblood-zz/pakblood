@include('header')
        <!-- Search area -->
@include('search_bar')
        <!-- Center Container-->
<div class="row center-container">
    <div id="login" class="row">
        <div>
            {!! Form::open(array('url' => '/password/reset','class' => 'small-20 medium-10 large-8 columns','style' => 'margin: auto 30%;')) !!}
            <h5>Reset Password</h5>
            @if (count($errors) > 0)
                <div class="row">
                    @foreach ($errors->all() as $error)
                        <small class="error small-20 medium-14 large-20 columns">{{ $error }}</small>
                    @endforeach
                </div>
            @endif
            @if(Session::get('message') != NULL)
                @if((Session::has('type')) && (Session::get('type')=='success'))
                    <div data-alert class="alert-box success radius   small-20 medium-14 large-20 columns"
                         style="text-align: center;font-weight: bold;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
                @if((Session::has('type')) && (Session::get('type')=='error'))
                    <div data-alert class="alert-box alert radius  error small-20 medium-14 large-20 columns"
                         style="text-align: center;font-weight: bold;">
                        {{ Session::get('message') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                @endif
            @endif
            <input type="hidden" name="token" value="{{ $token or '' }}">
            <input type="hidden" name="email" value="{{ $email or '' }}">
            {{-- <div class="row">
                 <div class="hide-for-small-only medium-6 large-6 columns">
                     {!! Form::label('email', 'E-Mail Address :' ,array('class' => 'inline')) !!}
                 </div>
                 <div class="small-20 medium-14 large-14 columns left">
                     {!! Form::email('email', Input::old('email'), array('class' => 'inline','id' => 'email','placeholder' => 'Email')) !!}
                 </div>
             </div>--}}
            <div class="row">
                <div class="hide-for-small-only medium-6 large-6 columns">
                    {!! Form::label('pass', 'Password :',array('class' => 'inline')) !!}
                </div>
                <div class="small-20 medium-14 large-14 columns left">
                    {!! Form::password('password', array('class' => 'inline','id' => 'pass','placeholder' => 'Password')) !!}
                </div>
            </div>
            <div class="row">
                <div class="hide-for-small-only medium-6 large-6 columns">
                    {!! Form::label('password_confirmation', 'Confirm Password :',array('class' => 'inline')) !!}
                </div>
                <div class="small-20 medium-14 large-14 columns left">
                    {!! Form::password('password_confirmation', array('class' => 'inline','id' => 'pass','placeholder' => 'Confirm Password')) !!}
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