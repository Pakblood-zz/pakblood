
<div>

    Dear {{$user->name}},<br><br>


    <p style="text-align: center;">
        Your Password Rest Link.<br><br>
        <a href="{!! URL::to('rest/password/'.$token) !!}">{{ URL::to('rest/password/'.$token) }}.<br></a><br>

    </p>



    @include ('emails.__footer')


</div>
