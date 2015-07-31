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
    {!! HTML::script('js/vendor/webshims/polyfiller.js') !!}
    {!! HTML::script('js/vendor/confirm_with_reveal.js') !!}

    <script>
        $(function(){
            $(document).foundation();
            $(document).confirmWithReveal({
                ok_class: 'small button radius',
                cancel_class: 'small button radius secondary'
            })
        });
    </script>
</head>
<body>
<!-- HEADER -->
<header>
    <div class="row myCenter">
        <div class="medium-20 large-9 columns right">
            @if (Auth::guest())
                <ul class="breadcrumbs right">
                    <li><a href="/register">Sign up </a></li>
                    <li><a href="/login">Login </a></li>
                    <li><a href="{{ url('/forgotpassword') }}">Forgot Password? </a></li>
                </ul>
            @else
                <ul class="breadcrumbs right">
                    @if(Auth::user()->org_id == 0)
                        <li><a href="/create/organization">Register Organization</a> <span style="color: red;">Or</span> <a href="/organizations">Join An Organization</a></li>
                    @endif
                    <li>
                        <div id="user_nav" class="right">
                            <a data-dropdown="drop1" aria-controls="drop1" aria-expanded="false">{{ Auth::user()->username}}</a>
                            <ul id="drop1" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
                                <li><a href="{{url('profile/'.Auth::user()->username)}}">My Profile</a></li>
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
                <li class="active"><a href="/">Home </a></li>
                {{--<li class="has-dropdown">
                    <a href="#">Dead Body Transfers </a>
                    <ul class="dropdown">
                        <li><a href="#">First link in dropdown </a></li>
                        <li class=""><a href="#">Active link in dropdown </a></li>
                    </ul>
                </li>--}}
                <li class=""><a href="#">Dead Body Transfers </a></li>
                <li class=""><a href="#">Help Line </a></li>
                <li class=""><a href="#">News </a></li>
                <li class=""><a href="#">FAQ </a></li>
                <li class=""><a href="#">Contact Us </a></li>
            </ul>
        </section>
    </nav>
</div>