    <h2>Report Donor </h2>
    {!! Form::open(array('url' => 'report/user')) !!}
    {!! Form::hidden('id',$id) !!}
    <div class="row">
        <div class="hide-for-small-only medium-6 large-6 columns">
            {!! Form::label('name', 'Your Name :' ,array('class' => 'inline')) !!}
        </div>
        <div class="small-20 medium-14 large-14 columns left">
            {!! Form::text('name', Input::old('name') , array('class' => 'inline','id' => 'name','placeholder' => 'Your Name')) !!}
        </div>
    </div>
    <div class="row">
        <div class="hide-for-small-only medium-6 large-6 columns">
            {!! Form::label('email', 'Your Email :' ,array('class' => 'inline')) !!}
        </div>
        <div class="small-20 medium-14 large-14 columns left">
            {!! Form::email('email', Input::old('email'), array('class' => 'inline','id' => 'email','placeholder' => 'Your Email')) !!}
        </div>
    </div>
    <div class="row">
        <div class="hide-for-small-only medium-6 large-6 columns">
            {!! Form::label('report_type', 'Report Reason :' ,array('class' => 'inline')) !!}
        </div>
        <div class="small-20 medium-14 large-14 columns left">
            <label>
                {!! Form::select('report_type', [
                'Out Of Contact' => 'Out Of Contact',
                'Fake Account' => 'Fake Account',
                'Quit Donating' => 'Quit Donating',
                'Other' => 'Other'
                ],
                array('class' => 'inline','id' => 'report_type')) !!}
            </label>
        </div>
    </div>
    <div class="row">
        <div class="hide-for-small-only medium-6 large-6 columns">
            {!! Form::label('comments', 'Comments :' ,array('class' => 'inline')) !!}
        </div>
        <div class="small-20 medium-14 large-14 columns left">
            {!! Form::textarea('comments', null, array('size' => '20x5', 'class' => 'inline','id' => 'comments', 'placeholer' => 'Your comments about donor')) !!}
        </div>
    </div>
    <div class="row">
        <div class="hide-for-small-only medium-6 large-6 columns">
            {!! Form::label('captcha', 'Captcha :',array('class' => 'inline')) !!}
        </div>
        <div style="margin-top: 10px;" class="small-20 medium-14 large-14 columns right">
            {!! app('captcha')->display(); !!}
        </div>
    </div>
    <div class="row">
        <div id="submit_btn" style="text-align: center;margin-top: 10px;" class="small-20 medium-20 large-20 columns">
            <input type="submit" class="small button radius" name="submit" value="Submit!">
        </div>
    </div>
    {!! Form::close() !!}
