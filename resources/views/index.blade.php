@include('header')
<!-- Slider -->
<div class="row hide-for-small-only">
    <div class="slider">
        {!! HTML::image('images/pakblood-banner.jpg', 'Slider', array('title' => 'Slider img','style' => 'width:100%')) !!}
    </div>
</div>
@include('search_bar')
<!-- Center Container-->

@if(isset($pictorial) && count($pictorial) > 2)
    <!-- Pictorial -->
    @include('pictorial')
@endif

<style>
    #countriesRegForm_chosen, #citiesRegForm_chosen {
        margin: 0;
    }
</style>
<div class="row center-container">
    <!-- left container -->
    <div class="small-20 medium-20 large-13 columns">
        <div id="donation-vid" class="">
            <div class="small-20 large-20">
                <h5 class="heading">Want to make a difference? Donate blood and save a life today with PakBlood!</h5>
                <br/>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/ezafVzfJw60" frameborder="0"
                        allowfullscreen></iframe>

                <p><br/>Blood is invaluable. It is enriched with useful components that are vital for a healthy human
                    body and above all- ‘life’. While you are gifted with good health, others may not be. Share your
                    gift with those who are suffering. Even a single blood donation is enough to help multiple patients.
                </p>

                <p>Remember! Nothing can substitute blood, but the blood itself. And somewhere, someone may be
                    holding on to dear life with a hope that someone (you!) will come to the rescue. Trust us, it hardly
                    takes 10-12 minutes to donate a single bottle of blood, which can bring smiles on hundreds of faces
                    and keep you satisfied by the mere thought of saving a life!
                </p>
            </div>
        </div>
        <div id="blood-need" class="row">
            <div class="small-19 large-19 columns">
                <h5 class="heading">Why You Need to Donate Blood:<br/> <br/></h5>
                <ul>
                    <li><i class="fa fa-arrow-right"></i>To replace blood lost due to accidents and blood diseases</li>
                    <li><i class="fa fa-arrow-right"></i>For major and minor operations like open heart surgery, transplants,
                        dialysis, etc
                    </li>
                    <li><i class="fa fa-arrow-right"></i>For the Anaemic patients and those who suffer hereditary diseases</li>
                    <li><i class="fa fa-arrow-right"></i>For mothers during child birth</li>
                    <li><i class="fa fa-arrow-right"></i>For new born infants during transfusion</li>
                    <li><i class="fa fa-arrow-right"></i>For children suffering from Thalassaemia and Hemophilia</li>
                </ul>
            </div>
        </div>

        <div id="blood-need" class="row">
            <div class="small-19 large-19 columns">
                <h5 class="heading">Donating Blood is Beneficial for You too:<br/> <br/></h5>
                <ul>
                    <li><i class="fa fa-arrow-right"></i>Reduces harmful iron stored that can lead to a heart attack</li>
                    <li><i class="fa fa-arrow-right"></i>You get a free check-up prior to the donation</li>
                    <li><i class="fa fa-arrow-right"></i>Normal iron-level reduces the risk of cancer</li>
                    <li><i class="fa fa-arrow-right"></i>You get a feeling of self-satisfaction by helping others</li>
                    <li><i class="fa fa-arrow-right"></i>Reduces laziness and accelerates weight loss (Good news for
                        over-weight fellows)
                    </li>
                    <li><i class="fa fa-arrow-right"></i>Stimulates the production of fresh blood cells</li>
                    <li><i class="fa fa-arrow-right"></i>You feel refreshed</li>
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
    <div id="right-container" class="small-20 medium-20 large-7 columns">
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
        <div class="row">
            <div class="small-20 columns show-for-medium-up" style="margin: 10px 0;text-align: center;">
            {{--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
            <!-- seostuff.com sidebar -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:300px;height:600px"
                     data-ad-client="ca-pub-1709767846664941"
                     data-ad-slot="7858605701"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
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
            <option value="m" {{ (isset($user) && isset($user->user['gender']) && $user->user['gender'] == 'Male')?'selected':'' }}>
                Male
            </option>
            <option value="f" {{ (isset($user) && isset($user->user['gender']) && $user->user['gender'] == 'Female')?'selected':'' }}>
                Female
            </option>
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