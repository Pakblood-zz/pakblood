<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Dear {{$user->name}},<br><br>
    Your Password Rest Link.<br>
    <a href="{!! URL::to('rest/password/'.$token) !!}">{{ URL::to('rest/password/'.$token) }}.<br></a><br>
    Regards,<br>
    Pakblood Team<br>

</div>

</body>
</html>