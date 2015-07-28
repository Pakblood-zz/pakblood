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