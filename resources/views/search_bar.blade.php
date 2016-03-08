<!-- Search area -->
<style>
    .error {
        font-size: 12px;
        text-align: center;
        display: none;
        color: red;
        background-color: white;
    }
</style>
<div class="row search-bar">
    <div class="myCenter" style="width: 100%;">
        @if(\Request::is('/') || \Request::is('home'))
            <div class="small-20 medium-20 large-7 colums left donors">
                <h3>{{$total_users}} Donors</h3>
                <span>{{$total_org}} Organizations Registered</span>
            </div>
        @endif
        <form id="searchForm" method="GET" action="{{url('/search')}}" accept-charset="UTF-8"
              class="{{ (\Request::is('/') || \Request::is('home'))?"large-13":"large-20" }} columns">
            <div class="small-20 medium-5 large-5 columns">
                <select name="bgroup">
                    <option value="" selected disabled>Blood Group</option>
                    <option value="Ap"<?php if (isset($bg) && ($bg == 'Ap')) echo 'selected="selected"'; ?>>A+</option>
                    <option value="An"<?php if (isset($bg) && ($bg == 'An')) echo 'selected="selected"'; ?>>A-</option>
                    <option value="Bp"<?php if (isset($bg) && ($bg == 'Bp')) echo 'selected="selected"'; ?>>B+</option>
                    <option value="Bn"<?php if (isset($bg) && ($bg == 'Bn')) echo 'selected="selected"'; ?>>B-</option>
                    <option value="Op"<?php if (isset($bg) && ($bg == 'Op')) echo 'selected="selected"'; ?>>O+</option>
                    <option value="On"<?php if (isset($bg) && ($bg == 'On')) echo 'selected="selected"'; ?>>O-</option>
                    <option value="ABp"<?php if (isset($bg) && ($bg == 'ABp')) echo 'selected="selected"'; ?>>AB+
                    </option>
                    <option value="ABn"<?php if (isset($bg) && ($bg == 'ABn')) echo 'selected="selected"'; ?>>AB-
                    </option>
                </select>
                <div class="error">Please Select Blood Group.</div>
            </div>
            <div class="small-20 medium-5 large-5 columns">
                <select name="country" id="countries" data-placeholder="Choose a Country..."
                        class="chosen-select">
                    <option value=""></option>
                    @foreach($countries as $row)
                        <option value="{{ $row->id }}" {{ (isset($country) && $country== $row->id)?"selected":"" }}>{{ $row->short_name }}</option>
                    @endforeach
                </select>
                <div class="error">Please Select Country.</div>
            </div>
            <div class="small-20 medium-5 large-5 columns">
                <select name="city" id="cities" data-placeholder="Choose a City..."
                        class="chosen-select" {{ (isset($city))?"":"disabled" }}>
                    <option value=""></option>
                    @if(isset($cities))
                        @foreach($cities as $row)
                            <option value="{{ $row->id }}" {{ (isset($city) && $city== $row->id)?"selected":"" }}>{{ $row->name }}</option>
                        @endforeach
                    @endif
                </select>
                <div class="error">Please Select City.</div>
            </div>
            <div id="search-btn" class="small-20 medium-5 large-5 columns">
                <a href="javascript:;" class="small button radius" value="Search" onclick="validateForm()">Search</a>
            </div>
        </form>
    </div>
</div>
<script>
    //ID of select containing countries and ID of select containing cities.
    countryAndCitySelect('countries', 'cities');
    function validateForm() {
        var form = $('#searchForm');
        var bgroupSelect = $('select[name=bgroup]');
        var countrySelect = $('div#countries_chosen');
        var citySelect = $('div#cities_chosen');
        if (bgroupSelect.val() == null) {
            bgroupSelect.parent().find('div.error').css('display', 'block');
            return false;
        } else {
            bgroupSelect.parent().find('div.error').css('display', 'none');
        }
        if (countrySelect.find('a').hasClass('chosen-default')) {
            countrySelect.parent().find('div.error').css('display', 'block');
            return false;
        } else {
            countrySelect.parent().find('div.error').css('display', 'none');
        }
        if (citySelect.find('a').hasClass('chosen-default')) {
            citySelect.parent().find('div.error').css('display', 'block');
            return false;
        } else {
            citySelect.parent().find('div.error').css('display', 'none');
        }
        form.submit();
    }
</script>