/**
 * Create chosen select for country and city selects
 * @param countryId
 * @param cityId
 * @param admin check if request is from admin
 */
function countryAndCitySelect(countryId, cityId, admin) {
    admin = admin | false;
    var countryDiv = $("#" + countryId);
    var cityDiv = $("#" + cityId);
    var country_id, select;
    var data = [];

    function updateCities() {
        //console.log(1);
        country_id = country_id || $('input[name=country_id]');
        select = select || cityDiv;
        select.find('option:not(option[value=""])').each(function () {
            $(this).remove();
        });
        cityDiv.trigger("change.select2");
        cityDiv.prop("disabled", true);
        if (admin) {
            $(cityDiv.parent()[0]).append('<div class="loading admin"><span>Loading</span><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
        } else {
            $(cityDiv.parent()[0]).append('<div class="loading"><span>Loading</span><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
        }
        //console.log(2);
        //return false;
        $.ajax({
            //dataType: 'json',
            type: 'GET',
            url: '/getCities/' + country_id,
            success: function (result) {
                if (result.status == 1) {
                    //                    console.log();
                    $.each(result.cities, function (i) {
                        //                        console.log(result.cities[i]);
                        data.push({id: result.cities[i]["id"], text: result.cities[i]["name"]});
                        select.append('<option value="' + result.cities[i]["id"] + '">' + result.cities[i]["name"] + '</option>');
                    });
                    cityDiv.prop("disabled", false);
                    $(cityDiv.parent()[0]).find('.loading').remove();
                    //console.log(3);
                    cityDiv.trigger("change.select2");
                }
            }
        });
    }

    cityDiv.select2({
        width: "100%"
    });
    countryDiv.select2({
        width: "100%"
    }).change(function () {
        //        console.log();
        country_id = $(this).val();
        select = cityDiv;
        updateCities();
    });
}
/**
 * Show preview of image that is being uploaded
 * @param input
 */
function imagePreview(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var previewDiv = $('#image_preview');
        //console.log(previewDiv);
        //console.log(previewDiv.find('img')[0]);
        reader.onload = function (e) {
            if (previewDiv.find('img')[0]) {
                //console.log(1);
                previewDiv.find('img').attr('src', e.target.result);
            } else {
                //console.log(2);
                previewDiv.append('<img src="' + e.target.result + '">');
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * Create select2 for list of active users.
 * @param userSelectId
 */
function usersSelect(userSelectId){
    var userId = 0;
    function updateAdminData() {
        if (userId != 0) {
            $.ajax({
                //dataType: 'json',
                type: 'GET',
                url: '/admin/getUser/' + userId,
                success: function (result) {
                    if (result.status == 1) {
                        $('#admin_name').val(result.user.name);
                        $('#email').val(result.user.email);
                        $('#username').val(result.user.username);
                    } else {
                        $('#admin_name').val('');
                        $('#email').val('');
                        $('#username').val('');
                    }
                },
                error: function (error) {
                    console.log("Error : " + error);
                    $('#admin_name').val('');
                    $('#email').val('');
                    $('#username').val('');
                }
            });
        } else {
            $('#admin_name').val('');
            $('#email').val('');
            $('#username').val('');
        }
    }
    $("#" + userSelectId).select2({
        width: "100%",
        allowClear: true
    }).change(function () {
        userId = $(this).val();
        updateAdminData();
    });
}