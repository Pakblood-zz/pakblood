@include('header')
@include('search_bar')
        <!-- Center Container-->
<style>
    #countriesRegForm_chosen, #citiesRegForm_chosen {
        margin: 0;
    }
</style>
<div class="row center-container">
    <!-- left container -->
    <div data-alert class="alert-box info radius">
        We have updated our internal system, If you have an organization registered with us please contact us
        <a href="mailto:info@pakblood.com">info@pakblood.com</a>, with your organization details.
    </div>
    <div id="left-container" class="small-20 medium-14 large-14 columns">
        <div id="add_org">
            <h5>Organizations Registration, <span>Every time you donate blood, you save 3 lives!</span></h5>
            <div>
                <p>Please only register if you want to maintain your own organization's donors list.
                    Members in your organizations will not be displayed in normal search.
                    For more details check the <a href="#">FAQs </a> or <a href="#">Contact Us</a></p>
            </div>
            <div>
                @if (count($errors) > 0)
                    <div class="row">
                        @foreach ($errors->all() as $error)
                            <small class="error small-20 medium-14 large-20">{{ $error }}</small>
                        @endforeach
                    </div>
                @endif
                {!! Form::open(array('url' => '/create/organization','enctype' => 'multipart/form-data')) !!}
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
                            {!! Form::label('org_address', 'Organization Address :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 large-10 medium-10 columns left">
                            {!! Form::text('org_address', Input::old('org_address'), array('class' => 'inline','id' => 'org_address','placeholder' => 'Organization Address')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            {!! Form::label('org_phone', 'Organization Phone :' ,array('class' => 'inline')) !!}
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::text('org_phone', Input::old('org_phone'), array('class' => 'inline','id' => 'org_phone','placeholder' => 'Organization Phone')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <label for="city" class="inline">Country : </label>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select name="country" id="countriesRegForm" data-placeholder="Choose a country..."
                                    class="chosen-select">
                                <option value=""></option>
                                @foreach($countries as $row)
                                    <option value="{{ $row->id }}">{{ $row->short_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <label for="city" class="inline">City : </label>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            <select name="city" id="citiesRegForm" data-placeholder="Choose a city..."
                                    class="chosen-select" disabled>
                                <option value=""></option>
                                @if(isset($cities))
                                    @foreach($cities as $row)
                                        <option value="{{ $row->id }}" {{ (Input::old('city') == $row->id)?"selected":"" }}>{{ $row->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <label for="org_url" class="inline">Organization Url : </label>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::url('org_url', Input::old('org_url'), array('class' => 'inline','id' => 'org_url','placeholder' => 'Organization Url')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <label for="org_logo" class="inline">Organization Logo : </label>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::file('org_logo', null, array('class' => 'inline','id' => 'org_logo')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only medium-7 large-5 columns">
                            <label for="org_application" class="inline">Application* : </label>
                        </div>
                        <div class="small-20 medium-10 large-10 columns left">
                            {!! Form::file('org_application', null, array('class' => 'inline','id' => 'org_application')) !!}
                        </div>
                    </div>
                    <p>*Upload Image of application to join Pakblood Organizations list written on your organization's
                        letter head </p>
                </div>
                <h5>Administrator Settings</h5>
                <div class="small-20 large-20 columns">
                    <div class="row">
                        <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                            <label for="admin_username" class="inline">Username : </label>
                        </div>
                        <div class="small-20 medium-10 large-6 columns left">
                            <input type="text" readonly id="admin_username" name="admin_username" placeholder="Username"
                                   value="{{Auth::user()->username}}">
                        </div>

                        <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                            <label for="admin_address" class="inline">Address : </label>
                        </div>
                        <div class="small-20 medium-10 large-6 columns left">
                            <input type="text" readonly id="admin_address" name="admin_address" placeholder="Adress"
                                   value="{{Auth::user()->address}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                            <label for="admin_name" class="inline">Admin Name : </label>
                        </div>
                        <div class="small-20 medium-10 large-6 columns left">
                            <input type="text" readonly id="admin_name" name="admin_name" placeholder="Admin Name"
                                   value="{{Auth::user()->name}}">
                        </div>

                        <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                            <label for="admin_program" class="inline">Degree/Program : </label>
                        </div>
                        <div class="small-20 medium-10 large-6 columns left">
                            <input type="text" readonly id="admin_program" name="admin_program"
                                   placeholder="Degree/Program">
                        </div>
                    </div>
                    <div class="row">
                        <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                            <label for="admin_phone" class="inline">Phone : </label>
                        </div>
                        <div class="small-20 medium-10 large-6 columns left">
                            <input type="text" readonly id="admin_phone" name="admin_phone" placeholder="Phone/Mobile"
                                   value="{{Auth::user()->phone}}">
                        </div>

                        <div class="hide-for-small-only hide-for-medium-only medium-7 large-4 columns">
                            <label for="admin_email" class="inline">Email : </label>
                        </div>
                        <div class="small-20 medium-10 large-6 columns left">
                            <input type="text" readonly id="admin_email" name="admin_email" placeholder="Email"
                                   value="{{Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="row" style="text-align:center;">
                        <input type="submit" class="small button radius" name="submit" value="Submit">
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
<script>
    //ID of select containing countries and ID of select containing cities.
    countryAndCitySelect('countriesRegForm', 'citiesRegForm');
</script>
@include('footer')