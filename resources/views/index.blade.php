@include('header')
        <!-- Slider -->
<div class="row hide-for-small-only">
    <div class="slider">
        {!! HTML::image('images/bannerSloder.jpg', 'Slider', array('title' => 'Slider img','style' => 'width:100%')) !!}
    </div>
</div>
@include('search_bar')
        <!-- Center Container-->
<style>
    #countriesRegForm_chosen, #citiesRegForm_chosen {
        margin: 0;
    }
</style>
<div class="row center-container">
    <!-- left container -->
    <div class="small-20 medium-13 large-13 columns">
        <div id="donation-vid" class="">
            <div class="small-20 large-20">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/ezafVzfJw60" frameborder="0"
                        allowfullscreen></iframe>
                <h5 class="heading"> Your blood donation may be even more special than you realize</h5>

                <p><br/>A single donation from you can help one or more patients. This is possible because whole blood
                    is
                    made up
                    of
                    several useful components.These components perform special functions in body. The various blood
                    components are Platelets, Plasma and selected Plasma Proteins.Each of these components can be
                    separated
                    from your donatedvolume of blood and transfused into a specific patient requiring that particular
                    component. Thus, many can benefit from one unit of blood.</p>
            </div>
        </div>
        <div id="blood-need" class="row">
            <div class="small-19 large-19 columns">
                <h5 class="heading"> Blood is needed every minute <br/> <br/></h5>
                <ul>
                    <li><i class="fa fa-plus"></i>To replace blood lost because of accidents or diseases.</li>
                    <li><i class="fa fa-plus"></i>For major & minor surgeries including open heart surgeries,
                        transplants
                        etc.
                    </li>
                    <li><i class="fa fa-plus"></i>For patients suffering from Anemia.</li>
                    <li><i class="fa fa-plus"></i>During child birth for the mother.</li>
                    <li><i class="fa fa-plus"></i>For exchange transfusion for new born infants.</li>
                    <li><i class="fa fa-plus"></i>For children suffering from ailments like Thalassaemia, Hemophilia.
                    </li>
                </ul>
            </div>
        </div>
        {{--<div id="wish-list" class="row">--}}
        {{--<div class="small-19 large-19 columns">--}}
        {{--<h5> Wish List is now connected with our--}}
        {{--<span> <a href="https://twitter.com/pak_blood/" target="_blank">twitter</a> </span> account.</h5>--}}
        {{--<table class="">--}}
        {{--<tr>--}}
        {{--<th>Group</th>--}}
        {{--<th>Urgently Require</th>--}}
        {{--<th>Contact info</th>--}}
        {{--<th>Date Required</th>--}}
        {{--</tr>--}}

        {{--<tr>--}}
        {{--<td><span>A+</span></td>--}}
        {{--<td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on--}}
        {{--Thursday 23rd April, 2015....--}}
        {{--</td>--}}
        {{--<td>0321-2654327</td>--}}
        {{--<td>14-JULY,2015</td>--}}
        {{--</tr>--}}
        {{--</table>--}}
        {{--<div class="btn">--}}
        {{--<a href="#" class="secondary button radius"><span>Read More </span></a>--}}
        {{--<a href="#" data-reveal-id="wishModal" class="button radius"><span>Post a Wish </span></a>--}}
        {{--<div id="wishModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true"--}}
        {{--role="dialog">--}}
        {{--<h2 id="modalTitle">Awesome. I have it.</h2>--}}
        {{--<p class="lead">Your couch. It is mine.</p>--}}
        {{--<p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>--}}
        {{--<a class="close-reveal-modal" aria-label="Close">&#215;</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
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
<div id="formModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    {!! Form::open(array('url' => (isset($fb) && $fb)?'fbAuth':'gpAuth')) !!}
    <input type="hidden" name="name" value="{{ (isset($user) && $user->name)?$user->name:'' }}">
    <input type="hidden" name="email" value="{{ (isset($user) && $user->email)?$user->email:'' }}">
    <input type="hidden" name="profile_image" value="{{ (isset($user) && $user->avatar)?$user->avatar:'' }}">
    <input type="hidden" name="social_id" value="{{ (isset($user) && $user->id)?$user->id:'' }}">
    <p>
        <select name="blood_group" required>
            <option value="">Blood Group</option>
            <option value="Ap">A+</option>
            <option value="An">A-</option>
            <option value="ABp">AB+</option>
            <option value="ABn">AB-</option>
            <option value="Bp">B+</option>
            <option value="Bn">B-</option>
            <option value="Op">O+</option>
            <option value="On">O-</option>
        </select>
    </p>
    <p>
        <select name="gender" required>
            <option value="" {{ (!isset($user))?'selected':'' }} disabled>Gender</option>
            <option value="m" {{ (isset($user)&& $user->user['gender'] == 'Male')?'selected':'' }}>Male</option>
            <option value="f" {{ (isset($user)&& $user->user['gender'] == 'Female')?'selected':'' }}>Female</option>
        </select>
    </p>
    <p>
        <input type="text" name="mobile" required placeholder="Phone Number">
    </p>
    <p>
        <select required name="country" id="countriesRegForm" data-placeholder="Choose a country..."
                class="chosen-select">
            <option value=""></option>
            @foreach($countries as $row)
                <option value="{{ $row->id }}" {{ (isset($country) && $country== $row->id)?"selected":"" }}>{{ $row->short_name }}</option>
            @endforeach
        </select>
    </p>
    <p>
        <select required name="city" id="citiesRegForm" data-placeholder="Choose a city..."
                class="chosen-select" {{ (isset($city))?"":"disabled" }}>
            <option value=""></option>
            @if(isset($cities))
                @foreach($cities as $row)
                    <option value="{{ $row->id }}" {{ (isset($city) && $city== $row->id)?"selected":"" }}>{{ $row->name }}</option>
                @endforeach
            @endif
        </select>
    </p>
    <p>
        <input type="submit" value="submit">
    </p>
    {!! Form::close() !!}
</div>
@if(isset($user))
    <script>
        countryAndCitySelect('countriesRegForm', 'citiesRegForm');
        $('#formModal').foundation('reveal', 'open', {
            close_on_background_click: false
        });
    </script>
@endif
@include('footer')