@include('header')
<!-- Slider -->
<div class="row hide-for-small-only">
    <div class="slider">
        {!! HTML::image('images/bannerSloder.jpg', 'Slider', array('title' => 'Slider img','style' => 'width:100%')) !!}
    </div>
</div>

<!-- Search area -->
<div class="row search-bar">
    <div class="myCenter">
        <div class="small-20 medium-20 large-7 colums left donors">
            <h3>1020 Donors</h3>
            <span>163 Organizations Registered</span>
        </div>
        <div class="medium-10 large-5 columns">
            <select>
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
        </div>
        <div class="medium-10 large-5 columns">
            <select>
                <option value="">Location/City</option>
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
        </div>
        <div id="search-btn" class="medium-20 large-3 columns">
            <a href="#" class="button radius"><span>Search</span></a>
        </div>
    </div>
</div>
<!-- Center Container-->
<div class="row center-container">
    <!-- left container -->
    <div class="small-20 medium-13 large-13 columns">
        <div id="donation-vid" class="">
            <div class="small-20 large-20">
                {!! HTML::image('images/video.jpg') !!}
                <h5 class="heading"> Your blood donation may be even more special than you realize</h5>

                <p><br/>A single donation from you can help one or more patients. This is possible because whole blood is
                    made up
                    of
                    several useful components.These components perform special functions in body. The various blood
                    components are Platelets, Plasma and selected Plasma Proteins.Each of these components can be separated
                    from your donatedvolume of blood and transfused into a specific patient requiring that particular
                    component. Thus, many can benefit from one unit of blood.</p>
            </div>
        </div>
        <div id="blood-need" class="row">
            <div class="small-19 large-19 columns">
                <h5 class="heading"> Blood is needed every minute <br/> <br/></h5>
                <ul>
                    <li><i class="fa fa-plus"></i>To replace blood lost because of accidents or diseases.</li>
                    <li><i class="fa fa-plus"></i>For major & minor surgeries including open heart surgeries, transplants
                        etc.
                    </li>
                    <li><i class="fa fa-plus"></i>For patients suffering from Anemia.</li>
                    <li><i class="fa fa-plus"></i>During child birth for the mother.</li>
                    <li><i class="fa fa-plus"></i>For exchange transfusion for new born infants.</li>
                    <li><i class="fa fa-plus"></i>For children suffering from ailments like Thalassaemia, Hemophilia.</li>
                </ul>
            </div>
        </div>
        <div id="wish-list" class="row">
            <div class="small-19 large-19 columns">
                <h5> Wish List is now connected with our <span>twitter</span> account.</h5>
                <table class="">
                    <tr>
                        <th>Group</th>
                        <th>Urgently Require</th>
                        <th>Contact info</th>
                        <th>Date Required</th>
                    </tr>

                    <tr>
                        <td><span>A+</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>

                    <tr>
                        <td><span>AB-</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>AB+</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>O-</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>O+</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>A-</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>B-</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>B+</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>A+</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>A-</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>O-</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                    <tr>
                        <td><span>O+</span></td>
                        <td>Urgently Required for an elderly patient in Meyo Hospital, Lahore on
                            Thursday 23rd April, 2015....
                        </td>
                        <td>0321-2654327</td>
                        <td>14-JULY,2015</td>
                    </tr>
                </table>
                <div class="btn">
                    <a href="#" class="secondary button radius"><span>Read More </span></a>
                    <a href="#" class="button radius"><span>Post a Wish </span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- right container -->
    <div id="right-container" class="small-20 medium-6 large-6 columns">
        <div id="promote-pakblood" class="row">
            <h5>Promote Pakblood</h5>

            <p>Use the images below on your Skype, MSN, Yahoo and Facebook etc. to promote a nobel cause and to display what
                type of blood you have. </p>
            <div class="promotion-imges">
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
                <div class="small-10 large-10 left columns"><a href="#">{!! HTML::image('images/a-.jpg') !!}</a></div>
            </div>
        </div>
        <div id="latest-updates" class="row">
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
        </div>
    </div>
</div>
@include('footer')