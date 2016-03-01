<!doctype html>
<!--[if IE 9]>
<html class="lt-ie10" lang="en"> <![endif]-->
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
    {!! HTML::style('css/foundation-icons/foundation-icons.css') !!}
    {!! HTML::style('css/jquery.datetimepicker.css') !!}

    {!! HTML::script('js/vendor/modernizr.js') !!}
    {!! HTML::script('js/vendor/fastclick.js') !!}
    {!! HTML::script('js/vendor/jquery.js') !!}
    {!! HTML::script('js/vendor/jquery.cookie.js') !!}
    {!! HTML::script('js/vendor/placeholder.js') !!}
    {!! HTML::script('js/foundation.js') !!}
    {!! HTML::script('js/responsive-tables.js') !!}
    {!! HTML::script('js/vendor/jquery.datetimepicker.js') !!}
    {!! HTML::script('js/vendor/confirm_with_reveal.js') !!}

    <script>
        $(function () {
            jQuery('.datetimepicker').datetimepicker({
                timepicker: false,
                format: 'd-M-y'
            });
            $(document).foundation({
                offcanvas: {
                    // Sets method in which offcanvas opens.
                    // [ move | overlap_single | overlap ]
                    open_method: 'overlap',
                    // Should the menu close when a menu link is clicked?
                    // [ true | false ]
                    close_on_click: false
                }
            });
            $(document).on('open.fndtn.offcanvas', '[data-offcanvas]', function () {
                $('#menu_icon').css('left', '18%');
                $('.main-section').css({left: '20%', width: '80%'});
                $('.panel_div').removeClass('small-5').addClass('small-7');
            });
            $(document).on('close.fndtn.offcanvas', '[data-offcanvas]', function () {
                $('#menu_icon').css('left', '0');
                $('.main-section').css({left: '1%', width: '98%'});
                $('.panel_div').removeClass('small-7').addClass('small-5');
            });
            $(document).confirmWithReveal({
                ok_class: 'small button radius',
                cancel_class: 'small button radius secondary',
                password: 'DELETE',
                body: 'Please type the following letter to confirm your action.'
            })
        });
    </script>
</head>
<body>
<!-- HEADER -->
<header>

</header>
