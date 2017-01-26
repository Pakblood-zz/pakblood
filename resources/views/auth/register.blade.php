@include('header')
        <!-- Search area -->
@include('search_bar')
        <!-- Center Container-->
<style>
    #countriesRegForm_chosen, #citiesRegForm_chosen {
        margin: 0;
    }
</style>
<div class="row center-container">
    <!-- left container -->
    <div id="left-container" class="small-20 medium-14 large-14 columns">
        <div id="add_member">
            @if(Auth::user()))
            <div id="add_member_nav">
                <a href="#">Main </a>
                <a href="#">Add Donor </a>
                <a href="#">Edit Profile </a>
                <a href="#">Edit Login </a>
                <a href="#">Search</a>
            </div>
            @endif
            <div id="add_member_heading">
                <h5>Donor Registration</h5>
                <p>Please don't create fake profiles, because you don't want to play with the life of a person.
                    Donor Information</p>
                @if (count($errors) > 0)
                    <div>
                        @foreach ($errors->all() as $error)
                            <small class="error">{{ $error }}</small>
                        @endforeach
                    </div>
                @endif
            </div>
            {{--<div class="large-20 columns" style="margin-bottom: 20px;">--}}
            {{--<div class="large-10 columns">--}}
            {{--<a href="{{ url('fblogin') }}" class="fb_btn button"><i class="fa fa-facebook-official"></i> <span>Sign-up With Facebook</span></a>--}}
            {{--</div>--}}
            {{--<div class="large-10 columns">--}}
            {{--<a href="{{ url('gplogin') }}" class="gp_btn button"><i class="fa fa-google-plus"></i> <span>Sign-up With Google+</span></a>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div>
                {!! Form::open(['url' => 'auth/register','id' => 'add_member_form']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="small-20 large-20 columns">
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('name', 'Name :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::text('name', Input::old('name'),
                                array('class' => 'inline validateInput','id' => 'name',
                                'placeholder' => 'Name','required'=>'required')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('username', 'Username :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 large-10 medium-10 columns left">
                                {!! Form::text('username', Input::old('username'),
                                array('class' => 'inline validateInput','id' => 'username','placeholder' => 'Username',
                                'required'=>'required','onfocusout'=>'checkData(this)')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('email', 'Email :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::email('email', Input::old('email'), array('class' => 'inline validateInput',
                                'id' => 'email', 'placeholder' => 'Email','required'=>'required',
                                'onfocusout'=>'checkData(this)')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('password', 'Password :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::password('password', array('class' => 'inline validateInput','id' => 'password',
                                'placeholder' => 'Password','required'=>'required','onfocusout'=>'checkData(this)')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('password_confirmation', 'Confirm Password :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::password('password_confirmation', array('class' => 'inline validateInput',
                                'id' => 'password_confirmation','placeholder' => 'Confirm Password','required'=>'required')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('gender', 'Gender :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::select('gender', [
                                '' => 'Select Your Gender',
                                'm' => 'Male',
                                'f' => 'Female']
                                ,null,['class'=>'validateSelect', 'required'=>'required']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('dob', 'Date Of Birth :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <input class="validateDate datetimepicker" style="vertical-align: baseline;" type="text" id="dob"
                                       name="dob" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('country', 'Country :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <select name="country" id="countriesRegForm" data-placeholder="Choose a country..."
                                        class="chosen-select validateSelect" required>
                                    <option value=""></option>
                                    @foreach($countries as $row)
                                        <option value="{{ $row->id }}" {{ (isset($country) && $country== $row->id)?"selected":"" }}>{{ $row->short_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('city', 'City :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <select name="city" id="citiesRegForm" data-placeholder="Choose a city..."
                                        class="chosen-select validateSelect"
                                        {{ (isset($city))?"":"disabled" }} required>
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
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('phone', 'Phone :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                <div class="small-5 medium-5 large-5 columns left no-left-padding">
                                    {!! Form::text('country_code', Input::old('country_code'), array('class' => 'inline',
                                'id' => 'country_code','placeholder' => '','readOnly'=>'true')) !!}
                                </div>
                                <div class="small-15 medium-15 large-15 columns left no-padding">
                                    {!! Form::text('phone', Input::old('phone'), array('class' => 'inline validateInput',
                                    'id' => 'phone','placeholder' => 'Phone Number','required'=>'required')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('mobile', 'Mobile# :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::text('mobile', Input::old('mobile'), array('class' => 'inline validateInput',
                                'id' => 'mobile','placeholder' => 'Mobile Number')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('address', 'Address :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::text('address', Input::old('address'), array('class' => 'inline validateInput',
                                'id' => 'address','placeholder' => 'Address')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="hide-for-small-only medium-7 large-5 columns">
                                {!! Form::label('bgroup', 'Blood Group :' ,array('class' => 'inline')) !!}
                            </div>
                            <div class="small-20 medium-10 large-10 columns left">
                                {!! Form::select('bgroup', [
                                '' => 'Select Your Blood Group',
                                'Ap' => 'A+',
                                'An' => 'A-',
                                'Bp' => 'B+',
                                'Bn' => 'B-',
                                'Op' => 'O+',
                                'On' => 'O-',
                                'ABp' => 'AB+',
                                'ABn' => 'AB-']
                                ,null,['class'=>'validateSelect', 'required'=>'required']) !!}
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
                        <div class="row">
                            <div id="submit_btn" class="small-20 medium-20 large-20 columns">
                                <input type="submit" class="small button radius" name="submit" value="Register!">
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- right container -->
    <div id="right-container" class="small-20 medium-6 large-6 columns">
        <div id="promote-pakblood" class="row">
            <h5>Promote Pakblood</h5>

            <p>Use the images below on your Skype, MSN, Yahoo and Facebook etc. to promote a nobel cause and to display
                what
                type of blood you have. </p>
            <div class="promotion-imges">
                <div class="small-10 large-10 left columns">
                    <a href="{{ url('images/ap.jpg') }}" target="_blank">{!! HTML::image('images/ap.jpg') !!}</a>
                </div>
                <div class="small-10 large-10 left columns">
                    <a href="{{ url('images/an.jpg') }}" target="_blank">{!! HTML::image('images/an.jpg') !!}</a>
                </div>
                <div class="small-10 large-10 left columns">
                    <a href="{{ url('images/bp.jpg') }}" target="_blank">{!! HTML::image('images/bp.jpg') !!}</a>
                </div>
                <div class="small-10 large-10 left columns">
                    <a href="{{ url('images/bn.jpg') }}" target="_blank">{!! HTML::image('images/bn.jpg') !!}</a>
                </div>
                <div class="small-10 large-10 left columns">
                    <a href="{{ url('images/abp.jpg') }}" target="_blank">{!! HTML::image('images/abp.jpg') !!}</a>
                </div>
                <div class="small-10 large-10 left columns">
                    <a href="{{ url('images/abn.jpg') }}" target="_blank">{!! HTML::image('images/abn.jpg') !!}</a>
                </div>
                <div class="small-10 large-10 left columns">
                    <a href="{{ url('images/op.jpg') }}" target="_blank">{!! HTML::image('images/op.jpg') !!}</a>
                </div>
                <div class="small-10 large-10 left columns">
                    <a href="{{ url('images/on.jpg') }}" target="_blank">{!! HTML::image('images/on.jpg') !!}</a>
                </div>
            </div>
        </div>
        {{--<div id="latest-updates" class="row">
            <h5 id="heading">Latest Updates</h5>
            <p>
                We are proude to inform all of our users that we are
                now available on twitter. We also have connected t
                he blood query / wish part to the twitter. On every
                single request coming to our website will be
                redirected to our twitter profile. Please do follow
                us on twitter. Thank you...</p>
            <div class="btn">
                <a href="#" class="secondary button radius"><span>Read More</span></a>
            </div>
            <h5 class="inner-heading"><a href="#">Blood Donors Organizations & Institutes</a></h5>

            <p>
                Thank you all for waiting so long. We have started
                work on Pakblood again. In past we have lost our
                concentration due to lack of time and pressure from
                other projects going on. But believe me, PAKB...
            </p>

            <div class="btn">
                <a href="#" class="button radius"><span>View All</span></a>
            </div>
        </div>--}}
    </div>
</div>
<script>
    //ID of select containing countries and ID of select containing cities.
    countryAndCitySelect('countriesRegForm', 'citiesRegForm');
    var errors = {};

    $("form").submit(function (event) {
        //        console.log(errors);
        var count = 0;
        console.log(Object.keys(errors).length);
        if (Object.keys(errors).length == 0) {
            /* var form = $('#add_member_form')[0];
             console.log(form);
             $(form).submit();
             console.log($(form[0]).submit());*/
            return;
        } else {
            event.preventDefault();
            $.each(errors, function (key, val) {
                console.log(key, val);
                var input = 'input[name=' + key + ']';
                $(input).parent().find('small.error').remove();
                $(input).parent().find('small.error.requireError').remove();
                $(input).after('<small class="error requireError">' + val + '</small>');
                $(input).addClass('validationError');
                $('#add_member_form').find('input[name=submit]').prop('disabled', true);
                if (count == 0) {
                    $(input).focus();
                }
                count += 1;
            });
        }
    });

    function checkData(e) {
        var field = e.name, val = $(e).val();
        if ($(e).val() == '') {
            /* $('input[name=submit]').prop('disabled', true);
             //            $(e).css({'outline': '1px solid red'});
             $(e).addClass('dataError');
             $(e).parent().find('small.error.dataError').remove();
             $(e).parent().find('small.error.requireError').remove();
             $(e).after('<small class="error dataError">' + field + ' is required.</small>');
             //            $(e).focus();*/
            if (typeof errors[field] === 'undefined') {
                errors[field] = field + ' is required.';
            }
        } else {
            if (typeof errors[field] !== 'undefined') {
                delete errors[field];
            }
            $.ajax({
                type: 'POST',
                url: '/checkUserExist',
                data: {'field': field, 'value': val, '_token': $('input[name=_token]').val()},
                success: function (result) {
                    //                    console.log(result);
                    if (result.status == 1) {
                        $('input[name=submit]').prop('disabled', true);
                        //                        $(e).css({'outline': '1px solid red'});
                        $(e).addClass('dataError');
                        $(e).parent().find('small.error.dataError').remove();
                        $(e).parent().find('small.error.requireError').remove();
                        $(e).after('<small class="error dataError">' + field + ' already exist.</small>');
                        //                        $(e).focus();
                        if (typeof errors[field] === 'undefined') {
                            errors[field] = field + ' already exist.';
                        }
                    } else if (result.status == -1) {
                        console.log(result.responseMessage);
                    } else {
                        $('input[name=submit]').prop('disabled', false);
                        $(e).removeClass('dataError');
                        $(e).parent().find('small.error.dataError').remove();
                        $(e).parent().find('small.error.requireError').remove();
                        if (typeof errors[field] !== 'undefined') {
                            delete errors[field];
                        }
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    }

    $(".validateInput").keyup(function (e) {
        var k = e.which;
        if (k == 20 /* Caps lock */
                || k == 16 /* Shift */
                || k == 9 /* Tab */
                || k == 27 /* Escape Key */
                || k == 17 /* Control Key */
                || k == 91 /* Windows Command Key */
                || k == 19 /* Pause Break */
                || k == 18 /* Alt Key */
                || k == 93 /* Right Click Point Key */
                || ( k >= 35 && k <= 40 ) /* Home, End, Arrow Keys */
                || k == 45 /* Insert Key */
                || ( k >= 33 && k <= 34 ) /*Page Down, Page Up */
                || (k >= 112 && k <= 123) /* F1 - F12 */
                || (k >= 144 && k <= 145 )) { /* Num Lock, Scroll Lock */
            return false;
        }
        validateInput(e.target);
    });

    $(".validateSelect, .validateDate").change(function (e) {
        //        console.log(e.target);
        //        console.log(e.target.type);
        //        console.log($(e.target).val());
        //        return false;
        validateInput(e.target);
    });

    function validateInput(element) {
        var field = element.name, val = $(element).val(), errorFlag = 0, errorHtml = "";
        /*str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
         return letter.toUpperCase();
         });*/
        //                console.log(element);
        //                        console.log(field);
        //                console.log(val);

        if (element.type == 'date') {
            var comp = val.split('-');
            var y = parseInt(comp[0], 10);
            var m = parseInt(comp[1], 10);
            var d = parseInt(comp[2], 10);
            var date = new Date(y, m - 1, d);
            if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
                console.log('Valid date');
                errorFlag = 0;
                errorHtml = "";
                if (typeof errors[field] !== 'undefined') {
                    delete errors[field];
                }
            } else {
                console.log('Invalid date');
                errorFlag = 1;
                errorHtml = "<small class='error validationError'>Please Select a valid date.</small>";
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' Please Select a valid date.';
                }
            }
        }

        if ($(element).is('select')) {
            if (field == 'gender') {
                if (val == '') {
                    errorFlag = 1;
                    errorHtml = "<small class='error validationError'>Please select your gender.</small>";
                    if (typeof errors[field] === 'undefined') {
                        errors[field] = field + 'Please select your gender.';
                    }
                } else {
                    errorFlag = 0;
                    errorHtml = "";
                    if (typeof errors[field] !== 'undefined') {
                        delete errors[field];
                    }
                }
            }
            if (field == 'country') {
                getCountryCallingCode(val);
            }
            if (field == 'bgroup') {
                if (val == '') {
                    errorFlag = 1;
                    errorHtml = "<small class='error validationError'>Please select your Blood Group.</small>";
                    if (typeof errors[field] === 'undefined') {
                        errors[field] = 'Please select your Blood Group.';
                    }
                } else {
                    errorFlag = 0;
                    errorHtml = "";
                    if (typeof errors[field] !== 'undefined') {
                        delete errors[field];
                    }
                }
            }
        }

        if (field == 'name') {
            if (val == '') {
                /*errorHtml = "<small class='error validationError'>" + field + " is required.</small>";
                 errorFlag = 1;*/
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' is required.';
                }
//                return false;
            }
            else if (val.match(/^[A-Za-z\s]+$/)) {
                errorFlag = 0;
            } else {
                errorFlag = 1;
                errorHtml = "<small class='error validationError'>" + field + " must have alphabet and space characters only.</small>";
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' must have alphabet and space characters only.';
                }
//                return false;
            }
            if (typeof errors[field] !== 'undefined') {
                delete errors[field];
            }
        }

        if (field == 'username') {
            if (val.match(/[+\-,!@#$%^&*();\\/|<>"']/)) {
                errorFlag = 1;
                errorHtml = "<small class='error validationError'>" + field + " can't not have special characters.</small>";
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' can\'t not have special characters.';
                }
            } else {
                errorFlag = 0;
                errorHtml = "";
                if (typeof errors[field] !== 'undefined') {
                    delete errors[field];
                }
            }
        }

        if (field == 'email') {
            if (!val.match(/(?:((?:[\w-]+(?:\.[\w-]+)*)@(?:(?:[\w-]+\.)*\w[\w-]{0,66})\.(?:[a-z]{2,6}(?:\.[a-z]{2})?));*)/)) {
                errorFlag = 1;
                errorHtml = "<small class='error validationError'>" + field + " is invalid.</small>";
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' is invalid.';
                }
            } else {
                errorFlag = 0;
                errorHtml = "";
                if (typeof errors[field] !== 'undefined') {
                    delete errors[field];
                }
            }
        }

        if (field == 'password') {
            if ($(element).val().length < 6) {
                errorHtml = "<small class='error validationError'>" + field + " must have at least 6 characters.</small>";
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' must have at least 6 characters.';
                }
            } else {
                errorFlag = 0;
                errorHtml = "";
                if (typeof errors[field] !== 'undefined') {
                    delete errors[field];
                }
            }
        }

        if (field == 'password_confirmation') {
            var password = $('input[name=password]').val();
            if (val != password) {
                errorFlag = 1;
                errorHtml = "<small class='error validationError'>" + field + " must match password.</small>";
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' must match password.';
                }
            } else {
                errorFlag = 0;
                errorHtml = "";
                if (typeof errors[field] !== 'undefined') {
                    delete errors[field];
                }
            }
        }

        if (field == 'phone') {
            if (val == '') {
                /*errorHtml = "<small class='error validationError'>" + field + " is required.</small>";
                 errorFlag = 1;*/
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' is required.';
                }
            }
            else if (val.match(/^[0-9\s]+$/)) {
                errorFlag = 0;
            } else {
                errorFlag = 1;
                errorHtml = "<small class='error validationError'>" + field + " must be numeric only.</small>";
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' must be numeric only.';
                }
//                return false;
            }
            if (typeof errors[field] !== 'undefined') {
                delete errors[field];
            }
        }

        if (field == 'mobile') {
            if (val.match(/^[0-9\s]+$/)) {
                errorFlag = 0;
                if (typeof errors[field] !== 'undefined') {
                    delete errors[field];
                }
            } else {
                errorFlag = 1;
                errorHtml = "<small class='error validationError'>" + field + " must be numeric only.</small>";
                if (typeof errors[field] === 'undefined') {
                    errors[field] = field + ' must be numeric only.';
                }
            }
        }

        if (errorFlag) {
            $(element).parent().find('small.error.validationError').remove();
            $(element).parent().find('small.error.requireError').remove();
            $(element).after(errorHtml);
            $(element).addClass('validationError');
            //            $(element).css({'outline': '1px solid red'});
            $('#add_member_form').find('input[name=submit]').prop('disabled', true);
        } else {
            $(element).parent().find('small.error.validationError').remove();
            $(element).parent().find('small.error.requireError').remove();
            $(element).removeClass('validationError');
            //            $(element).css({'outline': 'none'});
            $('#add_member_form').find('input[name=submit]').prop('disabled', false);
        }
    }

    function getCountryCallingCode(countryId) {
        $.ajax({
            type: 'GET',
            url: '/getCountryCallingCode/' + countryId,
            success: function (result) {
                //                console.log(result);
                var code = result.responseData[0].replace(/\+/g, ' ');
                $('input#country_code').val("+" + code);
                return true;
            },
            error: function (error) {
                console.log(error);
                return false;
            }
        });
    }
</script>
@include('footer')