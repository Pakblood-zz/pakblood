@include('admin.head')
<div class="large-5 columns admin_login">
    <div class="admin_login_top">
        {!! HTML::image('images/logo_fb.jpg', 'Logo', array('title' => 'Pakblood Logo')) !!}
        <h5>Admin Login</h5>
    </div>
    <div class="admin_login_form">
        @if (count($errors) > 0)
            <div class="row">
                @foreach ($errors->all() as $error)
                    <small class="error small-20 medium-14 large-20 columns">{{ $error }}</small>
                @endforeach
            </div>
        @endif
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
        {!! Form::open(array('url' => 'admin/login','class' => 'small-20 medium-20 large-20 columns','style' => 'margin: 5% auto;')) !!}
        <div class="row">
            <div class="row collapse">
                <div class="small-3 columns">
                    <li class="fi-torso"></li>
                </div>
                <div class="small-17 columns">
                    {!! Form::text('username', Input::old('username'), array('class' => 'inline','id' => 'username','placeholder' => 'Username')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row collapse">
                <div class="small-3 columns">
                    <li class="fi-lock"></li>
                </div>
                <div class="small-17 columns">
                    {!! Form::password('password', array('class' => 'inline','id' => 'pass','placeholder' => 'Password')) !!}
                </div>
            </div>
        </div>
        <div class="small-20 medium-20 large-20 columns" style="text-align: center;">
            <input type="submit" class="small button radius" name="submit" value="Login">
        </div>
        {!! Form::close() !!}
    </div>
</div>
</body>
</html>
