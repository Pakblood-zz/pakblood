@include('header')
@include('search_bar')
<!-- Center Container-->
<div id="top" class="row center-container">
    <h3 style="color: red">FAQs</h3>
    <a href="#q1" > Why I should donate blood?</a> <br />
    <a href="#q2" >What is PAKBLOOD?</a><br />
    <a href="#q3" >I can't find the blood?</a><br />
    <a href="#q4" >I want to donate money?</a><br />
    <a href="#q5" >How can I contribute?</a><br />
    <a href="#q6" >I entered wrong information, I want to correct it? </a><br />
    <a href="#q7" >I can't find the blood bank / hospital information of my city?</a><br />
    <a href="#q8" >I want to post some news on your site?</a><br />
    <a href="#q9" >What if I forget the password?</a> <br />
    <a href="#q10">How many times people searched my blood group in my city?</a><br />
    <a href="#q11">Have some other questions?</a><br />
    <br />

    <strong id="q1"> Why I should donate blood? </strong> <a href="#top"> back to top </a>
    <p>The love of fellow human and a
        desire to share something of oneself is what singles out a blood
        donor from the others. Emergencies occur every minute. For each
        patient requiring blood, it is an emergency and the patients
        could have set back if blood is not available.</p>

    <strong id="q2"> What is PAKBLOOD?</strong><a href="#top"> back to top </a>
    <p>PAKBLOOD is an online blood donors database. It is growing very fast.
        It have links with hospitals and blood banks. PAKBLOOD is creating blood donors
        societies in the colleges, and PAKBLOOD is totally free. You can play your role
        by donating your blood.</p>

    <strong id="q3"> I can't find the blood Required?</strong><a href="#top" class="link-green"> back to top </a>
    <p>If you can't find the blood that means that there is no record for
        required blood group in that area. If you need blood you can search near by cities or can search from whole province,
        also trying searching the educational institutes from search
        page.
    </p>

    <strong id="q4"> I want to donate money?<a name="q3" id="q3"></a></strong><a href="#top" class="link-green"> back to top </a>
    <p align="left">We will soon put the bank account number so you can donate to us easily and secure,
        currently we are updating the system so we can present every
        single transaction over internet to show you the transparency. </p>

    <strong id="q5"> How can I contribute?</strong><a href="#top"> back to top </a>
    <p>You can contribute by </p>
    <ul>
        <li>
            <p> Adding your blood record in our list.</p>
        </li>
        <li>
            <p> Donating
                money.</p>
        </li>
        <li>
            <p> Send us a list
                from your institute.</p>
        </li>
        <li>
            <p> You can also advertise for us,
                by just simply referring to us.</p>
        </li>
    </ul>

    <strong id="q6"> I entered wrong information, I want to correct it?</strong><a href="#top" > back to top </a>
    <p> Sign in by using login name, and password, then click on Edit Profile
        link.
    </p>

    <strong id="q7">I can't find the blood bank / hospital information of my city?</strong><a href="#top" > back to top </a>
    <p> It is hard to collect all the information. If you know any of the hospital's or blood bank's
        telephone number from your city or outside your city, you can <a href="{{url('/contact')}}" >Contact Us</a>.
    </p>

    <strong id="q8"> I want to post some news on your site?</strong><a href="#top" > back to top </a>
    <p> You can't post a news, until you have the Organization admin previlages. </p>

    <strong id="q9" > What if I forget the password? </strong><a href="#top" > back to top </a>
    <p> You can reset your current password by clicking on forget password. </p>

    <strong id="q10"> How many times people searched my blood group in my city?</strong><a href="#top" > back to top </a>
    <p> We can give this facility but this is not essential. </p>

    <strong id="q11" > Have some other questions? </strong><a href="#top" >back to top </a>
    <p> Click on <a href="{{url('/contact')}}" >Contact Us</a>
        link and mail us your question. We will reply you as soon as possible and try to put your question on here.
    </p>
</div>
@include('footer')