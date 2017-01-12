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
            <div id="submit_btn" class="small-20 medium-20 large-20 columns text-center">
                <a href="{{\URL::previous()}}" class="small button alert radius" name="cancel">Cancel</a>
                <input type="submit" class="small button radius" name="submit" value="Save">
            </div>
        </div>
    </div>
</div>