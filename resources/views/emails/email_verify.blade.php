<div>
    Dear {{$name}}, <br><br>

    Thank you for registering with us as a valued Blood Donor.<br><br>

    It is a great honor to have you with us, and we will make sure that you are satisfied with the privacy and security,
    and customer care we provide.<br><br>


    In order to continue, we need to make sure that the person creating account, is also owner of the email
    address. We don't want spammed users to fill our system.<br><br>


    <p style="text-align: center">

        Please click on the following link to activate your account.<br><br>
        <b> <a href="{!! URL::to('account/verify/' . $confirmation_code) !!}">{{ URL::to('account/verify/' . $confirmation_code) }}.</a></b><br>
    </p>


    @include ('emails.__footer')


</div>

