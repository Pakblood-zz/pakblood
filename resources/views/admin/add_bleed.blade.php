@include('admin.head')
@include('admin.side_bar')

<section class="main-section">
    <div class="page_wrapper">
        <div class="row"><h3 class="page_heading">{{$user->name}} </h3><div class="bg_icon"><li @if($user->gender == ('male')||('Male')) class="fi-torso size-72" @else class="fi-torso-female size-72" @endif></li></div></div>
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
            {!! Form::open(array('url' => '/admin/add/user/bleed')) !!}
            {!! Form::hidden('user_id', $user->id) !!}
            <div class="row">
                <div class="small-20 large-20 columns">
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('receiver_name', 'Receiver Name :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::text('receiver_name', Input::old('receiver_name'), array('class' => 'inline','id' => 'receiver_name','placeholder' => 'Receiver Name')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 large-10 medium-10 columns left">
                            {!! Form::text('city', Input::old('city'), array('class' => 'inline','id' => 'city','placeholder' => 'City Name')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('comments', 'Comments :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::textarea('comments', Input::old('comments'), array('style' => 'margin: 0 0 1rem 0;', 'size' => '30x5', 'class' => 'inline','id' => 'comments','placeholder' => 'Comments')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('date', 'Bleed Date :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::text('date', Input::old('date'), array('class' => 'inline datetimepicker','id' => 'date','placeholder' => 'Date')) !!}
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