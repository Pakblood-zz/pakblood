<!doctype html>
<!--[if IE 9]>
<html class="lt-ie10" lang="en"> <![endif]-->
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PakBlood.com Online Blood Donors Database O+, O-, B+, B-, AB+, AB-, A+, A-</title>
    <meta name="description"
          content="The largest blood donors database. A+, B+, AB+, B-, A-, AB-, O+, O-. Our aim is to create world wide database of donors from educational institutes. Registration is free"/>
    <meta name="keywords"
          content="blood, blood donor, blood sugar, blood work, cord blood, pakblood, Worldbank, Blood lahore, redcross, club25, fatmid foundation, sundas foundation"/>
    <meta name="robots" content="index,follow"/>
    <meta name="copyright" content="Copyright {{ date('Y') }}. PAKBLOOD. All Rights Reserved."/>
    <meta name="author" content=“http://aalasolutions.com“/>
    <meta name="language" content="English"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta property="og:title" content="Pakblood.com Online blood donors database"/>
    <meta property="og:type" content="cause"/>
    <meta property="og:url" content="http://www.pakblood.com"/>
    <meta property="og:image" content="http://www.pakblood.com/images/logo_fb.jpg"/>
    <meta property="og:site_name" content="Pakblood.com Online blood donors database"/>
    <link rel="icon" href="/favicon.ico" type="image/gif" sizes="16x16">
    {{--{!! HTML::style('css/zurb/foundation.css') !!}--}}
    {!! HTML::style('css/style.css') !!}
    {!! HTML::style('css/responsive-tables.css') !!}
    {!! HTML::style('css/jquery.datetimepicker.css') !!}
    {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css') !!}
    {!! HTML::style('css/select2.css') !!}
    {!! HTML::style('css/foundation-icons/foundation-icons.css') !!}

    {!! HTML::script('js/vendor/modernizr.js') !!}
    {!! HTML::script('js/vendor/fastclick.js') !!}
    {!! HTML::script('js/vendor/jquery.js') !!}
    {!! HTML::script('js/vendor/jquery.cookie.js') !!}
    {!! HTML::script('js/vendor/placeholder.js') !!}
    {!! HTML::script('js/foundation.js') !!}
    {!! HTML::script('js/responsive-tables.js') !!}
    {!! HTML::script('js/vendor/jquery.datetimepicker.js') !!}
    {!! HTML::script('js/vendor/confirm_with_reveal.js') !!}
    {!! HTML::script('js/vendor/select2/select2.full.js') !!}
    {!! HTML::script('js/myFunctions.js') !!}

    <script>
        $(function () {
            jQuery('.datetimepicker').datetimepicker({
                timepicker: false,
                format: 'd-M-y'
            });
            $(document).foundation();
            $(document).confirmWithReveal({
                ok_class: 'small button radius',
                cancel_class: 'small button radius secondary',
                title: 'Are you sure?',
                body: 'Are you sure you want to delete your account from Pakblood?',
                password: 'DELETE',
                ok: 'Confirm!'
            });
            FastClick.attach(document.body);
            $('.select2 span').addClass('needsclick');
            $('.select2-container span').addClass('needsclick');
        });
    </script>

    <!-- Google Add -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-1709767846664941",
            enable_page_level_ads: true
        });
    </script>
</head>
<body>
<!-- HEADER -->
<header>
    <div class=" row myCenter
    ">
        <div class="medium-20 large-9 columns right">
            @if (Auth::guest())
                <ul class="breadcrumbs right">
                    <li><a href="/register">Sign up </a></li>
                    <li><a href="/login">Login </a></li>
                    <li><a href="{{ url('/forgotpassword') }}">Forgot Password? </a></li>
                </ul>
            @else
                <ul class="breadcrumbs right">
                    {{-- @if(Auth::user()->org_id == 0)
                         <li><a href="/create/organization">Register Organization</a> <span style="color: red;">Or</span>
                             <a href="/organizations">Join An Organization</a></li>
                     @endif--}}
                    <li>
                        <div id="user_nav" class="right">
                            <a data-dropdown="drop1" aria-controls="drop1"
                               aria-expanded="false">{{ Auth::user()->name}}</a>
                            <ul id="drop1" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
                                <li>
                                    <?php
                                    $url = 'profile/';
                                    $url .= (\Auth::user()->username != '') ? \Auth::user()->username : \Auth::user()->id;
                                    ?>
                                    <a href="{{url($url)}}">My
                                        Profile</a></li>
                                @if(Auth::user()->org_id != 0)
                                    <li><a href="{{url('organization/'.Auth::user()->org_id)}}">My Organization</a></li>
                                @endif
                                <li><a href="{{url('auth/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            @endif
        </div>
        <div class="medium-20 large-11 columns left">
            <!-- LOGO -->
            <div class="logo">
                <a href="/">
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
                <li class="{{ (\Request::is('home') ||  \Request::is('/'))?"active":""}}"><a href="/">Home </a></li>
                {{--<li class="has-dropdown">
                    <a href="#">Dead Body Transfers </a>
                    <ul class="dropdown">
                        <li><a href="#">First link in dropdown </a></li>
                        <li class=""><a href="#">Active link in dropdown </a></li>
                    </ul>
                </li>--}}
                {{--<li class=""><a href="#">Dead Body Transfers </a></li>--}}
                <li class="{{ (\Request::is('helplines'))?"active":"" }}"><a href="{{url('/helplines')}}">Help
                        Line </a></li>
                {{--<li class=""><a href="#">News </a></li>--}}
                <li class="{{ (\Request::is('about'))?"active":"" }}"><a href="{{url('/about')}}">About </a></li>
                <li class="{{ (\Request::is('FAQ'))?"active":"" }}"><a href="{{url('/FAQ')}}">FAQ </a></li>
                <li class="{{ (\Request::is('contact'))?"active":"" }}"><a href="{{url('/contact')}}">Contact Us </a>
                </li>
            </ul>
        </section>
    </nav>
</div>