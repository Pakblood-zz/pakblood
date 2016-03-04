<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Dear {{$name}} <br><br>
    Please click on the following link to activate your account.<br>
    <a href="{!! URL::to('account/verify/' . $code) !!}">{{ URL::to('account/verify/' . $code) }}.</a><br>
    <br><br>
    DISCLAIMER: This e-mail and any file transmitted with it is confidential and intended solely for the use of the addressee.
    If you are not the intended recipient, you are notified that disclosing, copying,
    distributing or taking any action regarding the contents of this information is strictly prohibited.
    If you have received this email in error, please return the original to the sender and destroy the same immediately.
    Any views or opinions presented in this email are solely those of the author and do not necessarily represent those of
    the company.<br><br>

    WARNING: The recipient should check this email and any attachment for the presence of viruses.
    Although the company has taken reasonable precautions to ensure no viruses are present in this email,
    the company does not accept responsibility for any loss or damage arising from the use of this email or attachment.<br><br><br>
    Regards<br>
    Pakblood Team<br>
</div>

</body>
</html>