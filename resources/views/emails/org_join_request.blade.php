<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Dear {{$name}},<br><br>
    This email is to inform you that, your request to join {{$org_name}}, has been {{$status}}.<br><br>
    @include ('emails.__footer')

</div>

</body>
</html>