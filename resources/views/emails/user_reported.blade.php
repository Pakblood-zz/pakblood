<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Dear {{$name}}, <br>
    This email is to inform you that your account {{$email}} on pakblood has been reported.<br>
    For "{{ $reason }}", <br>
    Message <br>
    {{ $msg }} <br>
    Pakblood team will look into this report and if report is true your account will be deleted from <a
            href="http://pakblood.com/" target="_blank">Pakblood</a>.<br>
    Please contact us at <a href="mailto:info@pakblood.com">info@pakblood.com</a> for any queries.
</div>

</body>
</html>