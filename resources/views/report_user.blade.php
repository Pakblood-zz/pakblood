<h2>Report Donor </h2>
{!! Form::open(['url' => 'report/user']) !!}
{!! Form::hidden('id',$id) !!}
<div class="row">
    <div class="hide-for-small-only medium-6 large-6 columns">
        {!! Form::label('name', 'Your Name :' ,['class' => 'inline']) !!}
    </div>
    <div class="small-20 medium-14 large-14 columns left">
        {!! Form::text('name', Input::old('name') , ['class' => 'inline','required','id' => 'name','placeholder' => 'Your Name']) !!}
    </div>
</div>
<div class="row">
    <div class="hide-for-small-only medium-6 large-6 columns">
        {!! Form::label('email', 'Your Email :' ,['class' => 'inline']) !!}
    </div>
    <div class="small-20 medium-14 large-14 columns left">
        {!! Form::email('email', Input::old('email'), ['class' => 'inline','id' => 'email','placeholder' => 'Your Email','required']) !!}
    </div>
</div>
<div class="row">
    <div class="hide-for-small-only medium-6 large-6 columns">
        {!! Form::label('report_type', 'Report Reason :' ,array('class' => 'inline')) !!}
    </div>
    <div class="small-20 medium-14 large-14 columns left">
        <label>
            <select class="inline" id="report_type" required id="report_type" name="report_type">
                <option value="Out Of Contact">Out Of Contact</option>
                <option value="Fake Account">Fake Account</option>
                <option value="Quit Donating">Quit Donating</option>
                <option value="Other">Other</option>
            </select>
        </label>
    </div>
</div>
<div class="row">
    <div class="hide-for-small-only medium-6 large-6 columns">
        {!! Form::label('comments', 'Comments :' ,['class' => 'inline']) !!}
    </div>
    <div class="small-20 medium-14 large-14 columns left">
        {!! Form::textarea('comments', null, ['size' => '20x5', 'class' => 'inline','id' => 'comments', 'placeholer' => 'Your comments about donor','required']) !!}
    </div>
</div>
<div class="row">
    <div class="hide-for-small-only medium-6 large-6 columns">
        {!! Form::label('captcha', 'Captcha :',['class' => 'inline']) !!}
    </div>
    <div style="margin-top: 10px;" class="small-20 medium-14 large-14 columns right">
        {!! app('captcha')->display() !!}
    </div>
</div>
<div class="row">
    <div id="submit_btn" style="text-align: center;margin-top: 10px;" class="small-20 medium-20 large-20 columns">
        <input type="submit" class="small button radius" value="Submit!">
    </div>
</div>
{!! Form::close() !!}
