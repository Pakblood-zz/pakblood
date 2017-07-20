@include('header')
@include('search_bar')
<!-- Center Container-->
<div class="row center-container">
    <h3 style="color: red">Privacy Policy:</h3>
    <p align="justify">
        Currently, {{$total_org}} organizations are registered with PakBlood. We also feature a phonebook directory of nationwide
        hospitals. While most of the users are from Pakistan, donors from other countries can get themselves registered
        too.
    </p>
    <p align="justify">
        We keep your personal information in complete secrecy and use it only for the purpose of verification and
        communication. Our database system is equipped with the desired safety system, so to protect your private info.
        However, basic information like contact number and blood group is shared with the blood seekers, so they can
        easily connect with you.
    </p>
    <div id="blood-need" class="row privacy_policy">
        <h5 class="heading">We require information about your:</h5>
        <div class="small-19 large-19 columns">
            <ul>
                <li><i class="fa fa-arrow-right"></i>Physical health</li>
                <li><i class="fa fa-arrow-right"></i>Recent medical check-up</li>
                <li><i class="fa fa-arrow-right"></i>High risk behaviors</li>
                <li><i class="fa fa-arrow-right"></i>Medical history</li>
                <li><i class="fa fa-arrow-right"></i>Allergies and sensitivities</li>
                <li><i class="fa fa-arrow-right"></i>Contact</li>
                <li><i class="fa fa-arrow-right"></i>Blood group</li>
                <li><i class="fa fa-arrow-right"></i>Basic credentials</li>
            </ul>
        </div>
    </div>
    <div id="blood-need" class="row privacy_policy">
        <h5 class="heading">The information we require is necessary:</h5>
        <div class="small-19 large-19 columns">
            <ul>
                <li><i class="fa fa-arrow-right"></i>for ensuring safety of both donors and recipients</li>
                <li><i class="fa fa-arrow-right"></i>for communication via call, SMS and email for sending invitations
                    and information on donation related matters
                </li>
                <li><i class="fa fa-arrow-right"></i>for researches like market research and verification of our users
                </li>
                <li><i class="fa fa-arrow-right"></i>for managing and recording purposes</li>
                <li><i class="fa fa-arrow-right"></i>for carrying out administrative processes</li>
                <li><i class="fa fa-arrow-right"></i>for getting your feedback and improving our service</li>
            </ul>
        </div>
    </div>
    <p align="justify">
        It is our responsibility to keep your information safe. Your personal details will only be shared with someone
        after your permission. However, for legal purposes, we may not ask for your consent. Information regarding your
        donation can be passed on to trusted insurers and regulatory auditors, which will remain in their protection.
    </p>
    <p align="justify">
        If you want to access or update your personal information, feel free to contact us at
        <a href="mailto:info@pakblood.com" target="_top">info@pakblood.com</a>. We will
        answer all your queries regarding our privacy policy and resolve your complaints, if any.
    </p>
</div>
@include('footer')