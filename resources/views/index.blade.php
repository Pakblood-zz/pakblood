@include('header')
        <!-- Slider -->
<div class="row hide-for-small-only">
    <div class="slider">
        {!! HTML::image('images/bannerSloder.jpg', 'Slider', array('title' => 'Slider img','style' => 'width:100%')) !!}
    </div>
</div>
@include('search_bar')
        <!-- Center Container-->
<div class="row center-container">
    <!-- left container -->
    <div class="small-20 medium-13 large-13 columns">
        <div id="donation-vid" class="">
            <div class="small-20 large-20">
                {!! HTML::image('images/video.jpg') !!}
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
<div id="fbFormModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    {!! Form::open(array('url' => 'fbAuth')) !!}
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
        <select name="city_id" required>
            <option value="" selected disabled>Location/City</option>
            <option value="208">Lahore</option>
            <option value="169">Karachi</option>
            <option value="130">Islamabad</option>
            <option value="1">Abbotabad</option>
            <option value="4">Adda shaiwala</option>
            <option value="9">Arif wala</option>
            <option value="10">Arifwala</option>
            <option value="13">Badin</option>
            <option value="15">Bahawalpur</option>
            <option value="18">Barbar loi</option>
            <option value="25">Bhawal nagar</option>
            <option value="26">Bhera</option>
            <option value="28">Bhirya road</option>
            <option value="30">Bhurewala</option>
            <option value="41">Chakwal</option>
            <option value="42">Charsada</option>
            <option value="68">Dera ghazi khan</option>
            <option value="76">Dina</option>
            <option value="85">Faisalabad</option>
            <option value="90">Feteh jhang</option>
            <option value="103">Ghotki</option>
            <option value="111">Gujranwala</option>
            <option value="112">Gujrat</option>
            <option value="118">Haroonabad</option>
            <option value="125">Hayatabad</option>
            <option value="129">Hyderabad</option>
            <option value="132">Jaccobabad</option>
            <option value="141">Jaranwala</option>
            <option value="147">Jhang</option>
            <option value="149">Jhelum</option>
            <option value="174">Kasur</option>
            <option value="176">Khair pur</option>
            <option value="181">Khanewal</option>
            <option value="186">Khewra</option>
            <option value="193">Kot addu</option>
            <option value="202">Kotli loharan</option>
            <option value="203">Kotri</option>
            <option value="227">Mandi bahauddin</option>
            <option value="232">Mangla</option>
            <option value="249">Mirpur khas</option>
            <option value="256">Multan</option>
            <option value="262">Muzaffarabad</option>
            <option value="266">Narowal</option>
            <option value="275">Nowshera</option>
            <option value="278">Okara</option>
            <option value="285">Patoki</option>
            <option value="286">Peshawar</option>
            <option value="302">Rahimyar khan</option>
            <option value="304">Raiwand</option>
            <option value="311">Rawalpindi</option>
            <option value="316">Sadiqabad</option>
            <option value="318">Sahiwal</option>
            <option value="332">Sargodha</option>
            <option value="341">Shaikhupura</option>
            <option value="350">Sialkot</option>
            <option value="358">Sohawa district jelum</option>
            <option value="365">Talhur</option>
            <option value="374">Taxila</option>
            <option value="381">Topi</option>
            <option value="391">Vehari</option>
            <option value="392">Wah cantt</option>
        </select>
    </p>
    <p>
        <input type="submit" value="submit">
    </p>
    {!! Form::close() !!}
</div>
@if(isset($user))
    <script>
        $('#fbFormModal').foundation('reveal', 'open', {
            close_on_background_click: false
        });
    </script>
@endif
@include('footer')