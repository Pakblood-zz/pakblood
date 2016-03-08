<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    New User Registered.<br>
    Name : {{ $name }} <br>
    Username : {{ $username }} <br>
    Email : {{ $email }} <br>
    Gender : {{ ($gender == 'm')?"Male":"Female" }} <br>
    Date Of Birth : {{ $dob }} <br>
    Phone : {{ $phone }} <br>
    Mobile : {{ $mobile }} <br>
    Address : {{ $address }} <br>
    City : {{ $city }} <br>
    Blood Group : {{ $blood_group }} <br>
    Status : {{ $status }} <br>
</div>

</body>
</html>