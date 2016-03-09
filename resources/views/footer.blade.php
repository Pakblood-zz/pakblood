<!-- FOOTER -->
<div class="footer">
    <footer>
        <div class="row">
            <nav>
                <a href="{{ url('/home') }}">Home </a>
                <a href="{{ url('/helplines') }}">Help Line </a>
                <a href="{{ url('/about') }}">About </a>
                <a href="{{ url('/contact') }}">Contact</a>
            </nav>
        </div>
        <div class="row">
            <p> Pakblood © {{ date('Y') }} by <a href="http://aalasolutions.com/" target="_blank">AA'LA Solutions.</a> All rights
                reserved</p>
            <p>"Pakblood" is not responsible of any misuse of the information, numbers or any other material presented
                on
                the site.</p>
        </div>
    </footer>
</div>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-720933-16', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>