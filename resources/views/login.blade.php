
<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pakblood</title>

    <meta name="description" content="Pakblood...">
    <meta name="author" content="Pakblood website">
    <meta name="copyright" content="Pakblood inc">

    {!! HTML::style('css/style.css') !!}
    {!! HTML::style('css/responsive-tables.css') !!}

    {!! HTML::script('js/vendor/modernizr.js') !!}
    {!! HTML::script('js/vendor/fastclick.js') !!}
    {!! HTML::script('js/vendor/jquery.js') !!}
    {!! HTML::script('js/vendor/jquery.cookie.js') !!}
    {!! HTML::script('js/vendor/placeholder.js') !!}
    {!! HTML::script('js/foundation.js') !!}
    {!! HTML::script('js/responsive-tables.js') !!}

    <script>
        $(function(){
            $(document).foundation();
        });
    </script>
</head>
<body>
<!-- HEADER -->
<header>
    <div class="row myCenter">
        <div class="medium-20 large-9 columns right">
            <ul class="breadcrumbs right">
                <li><a href="#">Sign up </a></li>
                <li><a href="#">Login </a></li>
                <li><a href="#">Forgot Password? </a></li>
            </ul>
        </div>
        <div class="medium-20 large-11 columns left">
            <!-- LOGO -->
            <div class="logo">
                <a href="#">
                    {!! HTML::image('images/PAKblood.png', 'Pakblood', array('title' => 'pakblood logo')) !!}
                    <span class="hide-for-small-only" id="tag-save-life">save life</span>
                    <span class="hide-for-small-only" id="tag-line">And whoever save one Life - it is as if he had saved mankind entirely</span>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Navigation -->
<div id="menu" class="row sticky">
    <nav class="top-bar" data-topbar role="navigation" data-options="scrolltop:false">
        <ul class="title-area resp-menu">
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="active toggle-topbar menu-icon" style="width: 100%"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul>
                <li class="active"><a href="#">Home </a></li>
                <li class="has-dropdown">
                    <a href="#">Dead Body Transfers </a>
                    <ul class="dropdown">
                        <li><a href="#">First link in dropdown </a></li>
                        <li class=""><a href="#">Active link in dropdown </a></li>
                    </ul>
                </li>
                <li class=""><a href="#">Help Line </a></li>
                <li class=""><a href="#">News </a></li>
                <li class=""><a href="#">Videos </a></li>
                <li class=""><a href="#">FAQ </a></li>
                <li class=""><a href="#">Contact Us </a></li>
            </ul>
        </section>
    </nav>
</div>

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
<div id="login" class="row">
    <div class="small-20 medium-10 large-10 columns">
        <h5>Donor Login</h5>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-4 columns">
                <label for="username" class="inline">Username : </label>
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <input type="text" id="username" placeholder="Username">
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-4 columns">
                <label for="pass" class="inline">Password : </label>
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <input type="text" id="pass" placeholder="Password">
            </div>
        </div>
        <div class="login_btn small-20 medium-17 large-14 columns">
            <input type="submit" class="small button radius" name="submit" value="Login">
        </div>
    </div>
    <div class="small-20 medium-10 large-10 columns">
        <h5>Organization Login</h5>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-6 columns">
                <label for="org" class="inline">Organzation Name : </label>
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <input type="text" id="org" placeholder="Organzation Name">
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-6 columns">
                <label for="org_username" class="inline">Username : </label>
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <input type="text" id="org_username" placeholder="Username">
            </div>
        </div>
        <div class="row">
            <div class="hide-for-small-only medium-7 large-6 columns">
                <label for="org_pass" class="inline">Password : </label>
            </div>
            <div class="small-20 medium-10 large-10 columns left">
                <input type="text" id="org_pass" placeholder="password">
            </div>
        </div>
        <div class="login_btn small-20 medium-17 large-16 columns">
            <input type="submit" class="small button radius" name="submit" value="Login">
        </div>
    </div>
    <div></div>
</div>
</div>
<!-- FOOTER -->
<div class="footer">
    <footer>
        <div class="row">
            <nav>
                <a href="#">Home </a>
                <a href="#">Help Line </a>
                <a href="#">News </a>
                <a href="#">Articles </a>
                <a href="#">About </a>
                <a href="#">FAQ </a>
                <a href="#">Contact Us</a>
            </nav>
        </div>
        <div class="row">
            <h5> Pakblood © 2015 by <a href="#">AA'LA Solutions.</a> All rights reserved</h5>
            <p>"Pakblood" is not responsible of any misuse of the information, numbers or any other material presented on
                the site.</p>
        </div>
    </footer>
</div>
</body>


</html>


