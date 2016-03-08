
<div>
    Dear {{$name}}, <br><br>
    Your
    @if(isset($fb_id))<a href="https://facebook.com/{{$fb_id}}">Facebook</a>@endif
    @if(isset($gp_id))<a href="https://plus.google.com/{{$gp_id}}">Google+</a>@endif
    account has been successfully linked with Pakblood account.<br><br>


    You can now login with using

    @if(isset($fb_id))<a href="https://facebook.com/{{$fb_id}}">Facebook</a>@endif
    @if(isset($gp_id))<a href="https://plus.google.com/{{$gp_id}}">Google+</a>@endif

    profile.

    @include ('emails.__footer')



</div>

