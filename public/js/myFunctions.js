/**
 * Create chosen select for country and city selects
 * @param countryId
 * @param cityId
 */
function countryAndCitySelect(countryId, cityId) {
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
        console.log();
        $(cityDiv.parent()[0]).append('<div class="loading"><span>Loading</span><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
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