<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Dear {{$name}}, <br>
    Your
    @if(isset($fb_id))<a href="https://facebook.com/{{$fb_id}}">Facebook</a>@endif
    @if(isset($gp_id))<a href="https://plus.google.com/{{$gp_id}}">Google+</a>@endif
    account has been successfully linked with pakblood account.<br>
    Please contact us at <a href="mailto:info@pakblood.com">info@pakblood.com</a> for any queries.
</div>

</body>
</html>