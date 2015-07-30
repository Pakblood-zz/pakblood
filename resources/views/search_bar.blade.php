<!-- Search area -->
<div class="row search-bar">
    <div class="myCenter">
        <div class="small-20 medium-20 large-7 colums left donors">
            <h3>{{$total_users}} Donors</h3>
            <span>{{$total_org}} Organizations Registered</span>
        </div>
        <form method="GET" action="{{url('/search')}}" accept-charset="UTF-8" >
            <div class="medium-10 large-5 columns">
                <select required="required" name="bgroup">
                    <option value="">Blood Group </option>
                    <option value="Ap"<?php if(isset($bg)&& ($bg == 'Ap')) echo 'selected="selected"'; ?>>A+</option>
                    <option value="An"<?php if(isset($bg)&& ($bg == 'An')) echo 'selected="selected"'; ?>>A-</option>
                    <option value="Bp"<?php if(isset($bg)&& ($bg == 'Bp')) echo 'selected="selected"'; ?>>B+</option>
                    <option value="Bn"<?php if(isset($bg)&& ($bg == 'Bn')) echo 'selected="selected"'; ?>>B-</option>
                    <option value="Op"<?php if(isset($bg)&& ($bg == 'Op')) echo 'selected="selected"'; ?>>O+</option>
                    <option value="On"<?php if(isset($bg)&& ($bg == 'On')) echo 'selected="selected"'; ?>>O-</option>
                    <option value="ABp"<?php if(isset($bg)&& ($bg == 'ABp')) echo 'selected="selected"'; ?>>AB+</option>
                    <option value="ABn"<?php if(isset($bg)&& ($bg == 'ABn')) echo 'selected="selected"'; ?>>AB-</option></select>
                </select>
            </div>
            <div class="medium-10 large-5 columns">
                <select required="required" name="city">
                    <option value="">Location </option>
                    <option value="208"<?php if(isset($city) && ($city == '208')) echo 'selected="selected"'; ?>>Lahore</option>
                    <option value="169"<?php if(isset($city) && ($city == '169')) echo 'selected="selected"'; ?>>Karachi</option>
                    <option value="130"<?php if(isset($city) && ($city == '130')) echo 'selected="selected"'; ?>>Islamabad</option>
                    <option value="1"<?php if(isset($city) && ($city == '1')) echo 'selected="selected"'; ?>>Abbotabad</option>
                    <option value="4"<?php if(isset($city) && ($city == '4')) echo 'selected="selected"'; ?>>Adda shaiwala</option>
                    <option value="9"<?php if(isset($city) && ($city == '9')) echo 'selected="selected"'; ?>>Arif wala</option>
                    <option value="10"<?php if(isset($city) && ($city == '10')) echo 'selected="selected"'; ?>>Arifwala</option>
                    <option value="13"<?php if(isset($city) && ($city == '13')) echo 'selected="selected"'; ?>>Badin</option>
                    <option value="15"<?php if(isset($city) && ($city == '15')) echo 'selected="selected"'; ?>>Bahawalpur</option>
                    <option value="18"<?php if(isset($city) && ($city == '18')) echo 'selected="selected"'; ?>>Barbar loi</option>
                    <option value="25"<?php if(isset($city) && ($city == '25')) echo 'selected="selected"'; ?>>Bhawal nagar</option>
                    <option value="26"<?php if(isset($city) && ($city == '26')) echo 'selected="selected"'; ?>>Bhera</option>
                    <option value="28"<?php if(isset($city) && ($city == '28')) echo 'selected="selected"'; ?>>Bhirya road</option>
                    <option value="30"<?php if(isset($city) && ($city == '30')) echo 'selected="selected"'; ?>>Bhurewala</option>
                    <option value="41"<?php if(isset($city) && ($city == '41')) echo 'selected="selected"'; ?>>Chakwal</option>
                    <option value="42"<?php if(isset($city) && ($city == '42')) echo 'selected="selected"'; ?>>Charsada</option>
                    <option value="68"<?php if(isset($city) && ($city == '68')) echo 'selected="selected"'; ?>>Dera ghazi khan</option>
                    <option value="76"<?php if(isset($city) && ($city == '76')) echo 'selected="selected"'; ?>>Dina</option>
                    <option value="85"<?php if(isset($city) && ($city == '85')) echo 'selected="selected"'; ?>>Faisalabad</option>
                    <option value="90"<?php if(isset($city) && ($city == '90')) echo 'selected="selected"'; ?>>Feteh jhang</option>
                    <option value="103"<?php if(isset($city) && ($city == '103')) echo 'selected="selected"'; ?>>Ghotki</option>
                    <option value="111"<?php if(isset($city) && ($city == '111')) echo 'selected="selected"'; ?>>Gujranwala</option>
                    <option value="112"<?php if(isset($city) && ($city == '112')) echo 'selected="selected"'; ?>>Gujrat</option>
                    <option value="118"<?php if(isset($city) && ($city == '118')) echo 'selected="selected"'; ?>>Haroonabad</option>
                    <option value="125"<?php if(isset($city) && ($city == '125')) echo 'selected="selected"'; ?>>Hayatabad</option>
                    <option value="129"<?php if(isset($city) && ($city == '129')) echo 'selected="selected"'; ?>>Hyderabad</option>
                    <option value="132"<?php if(isset($city) && ($city == '132')) echo 'selected="selected"'; ?>>Jaccobabad</option>
                    <option value="141"<?php if(isset($city) && ($city == '141')) echo 'selected="selected"'; ?>>Jaranwala</option>
                    <option value="147"<?php if(isset($city) && ($city == '147')) echo 'selected="selected"'; ?>>Jhang</option>
                    <option value="149"<?php if(isset($city) && ($city == '149')) echo 'selected="selected"'; ?>>Jhelum</option>
                    <option value="174"<?php if(isset($city) && ($city == '174')) echo 'selected="selected"'; ?>>Kasur</option>
                    <option value="176"<?php if(isset($city) && ($city == '176')) echo 'selected="selected"'; ?>>Khair pur</option>
                    <option value="181"<?php if(isset($city) && ($city == '181')) echo 'selected="selected"'; ?>>Khanewal</option>
                    <option value="186"<?php if(isset($city) && ($city == '186')) echo 'selected="selected"'; ?>>Khewra</option>
                    <option value="193"<?php if(isset($city) && ($city == '193')) echo 'selected="selected"'; ?>>Kot addu</option>
                    <option value="202"<?php if(isset($city) && ($city == '202')) echo 'selected="selected"'; ?>>Kotli loharan</option>
                    <option value="203"<?php if(isset($city) && ($city == '203')) echo 'selected="selected"'; ?>>Kotri</option>
                    <option value="227"<?php if(isset($city) && ($city == '227')) echo 'selected="selected"'; ?>>Mandi bahauddin</option>
                    <option value="232"<?php if(isset($city) && ($city == '232')) echo 'selected="selected"'; ?>>Mangla</option>
                    <option value="249"<?php if(isset($city) && ($city == '249')) echo 'selected="selected"'; ?>>Mirpur khas</option>
                    <option value="256"<?php if(isset($city) && ($city == '256')) echo 'selected="selected"'; ?>>Multan</option>
                    <option value="262"<?php if(isset($city) && ($city == '262')) echo 'selected="selected"'; ?>>Muzaffarabad</option>
                    <option value="266"<?php if(isset($city) && ($city == '266')) echo 'selected="selected"'; ?>>Narowal</option>
                    <option value="275"<?php if(isset($city) && ($city == '275')) echo 'selected="selected"'; ?>>Nowshera</option>
                    <option value="278"<?php if(isset($city) && ($city == '278')) echo 'selected="selected"'; ?>>Okara</option>
                    <option value="285"<?php if(isset($city) && ($city == '285')) echo 'selected="selected"'; ?>>Patoki</option>
                    <option value="286"<?php if(isset($city) && ($city == '286')) echo 'selected="selected"'; ?>>Peshawar</option>
                    <option value="302"<?php if(isset($city) && ($city == '302')) echo 'selected="selected"'; ?>>Rahimyar khan</option>
                    <option value="304"<?php if(isset($city) && ($city == '304')) echo 'selected="selected"'; ?>>Raiwand</option>
                    <option value="311"<?php if(isset($city) && ($city == '311')) echo 'selected="selected"'; ?>>Rawalpindi</option>
                    <option value="316"<?php if(isset($city) && ($city == '316')) echo 'selected="selected"'; ?>>Sadiqabad</option>
                    <option value="318"<?php if(isset($city) && ($city == '318')) echo 'selected="selected"'; ?>>Sahiwal</option>
                    <option value="332"<?php if(isset($city) && ($city == '332')) echo 'selected="selected"'; ?>>Sargodha</option>
                    <option value="341"<?php if(isset($city) && ($city == '341')) echo 'selected="selected"'; ?>>Shaikhupura</option>
                    <option value="350"<?php if(isset($city) && ($city == '350')) echo 'selected="selected"'; ?>>Sialkot</option>
                    <option value="358"<?php if(isset($city) && ($city == '358')) echo 'selected="selected"'; ?>>Sohawa district jelum</option>
                    <option value="365"<?php if(isset($city) && ($city == '365')) echo 'selected="selected"'; ?>>Talhur</option>
                    <option value="374"<?php if(isset($city) && ($city == '374')) echo 'selected="selected"'; ?>>Taxila</option>
                    <option value="381"<?php if(isset($city) && ($city == '381')) echo 'selected="selected"'; ?>>Topi</option>
                    <option value="391"<?php if(isset($city) && ($city == '391')) echo 'selected="selected"'; ?>>Vehari</option>
                    <option value="392"<?php if(isset($city) && ($city == '392')) echo 'selected="selected"'; ?>>Wah cantt</option>
                </select>
            </div>
            <div id="search-btn" class="medium-20 large-3 columns">
                <input type="submit" class="small button radius" value="Search">
            </div>
        </form>
    </div>
</div>