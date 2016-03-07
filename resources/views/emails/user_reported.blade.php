<div>
    Dear {{$name}}, <br><br>
    This email is to inform you that your account {{$email}} on Pakblood has been reported.<br><br>


    For: "{{ $reason }}", <br>
    Message: <br>
    {{ $msg }} <br><br>


    Pakblood team will look into this report and if report is valid your account will be deleted from
    <a href="http://pakblood.com/" target="_blank">Pakblood</a>.<br>


    @include ('emails.__footer')

</div>
