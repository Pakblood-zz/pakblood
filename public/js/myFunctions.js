/**
 * Create chosen select for country and city selects
 * @param countryId
 * @param cityId
 */
function countryAndCitySelect(countryId, cityId) {
    var countryDiv = $("#" + countryId);
    var cityDiv = $("#" + cityId);
    var country_id, select;

    function updateCities() {
        country_id = country_id || $('input[name=country_id]');
        select = select || cityDiv;
        select.find('option:not(option[value=""])').each(function () {
            $(this).remove();
        });
        cityDiv.trigger("chosen:updated");
        $.ajax({
            //dataType: 'json',
            type: 'GET',
            url: '/getCities/' + country_id,
            success: function (result) {
                if (result.status == 1) {
//                    console.log();
                    $.each(result.cities, function (i) {
//                        console.log(result.cities[i]);
                        select.append('<option value="' + result.cities[i]["id"] + '">' + result.cities[i]["name"] + '</option>');
                    });
                    cityDiv.prop("disabled", false);
                    cityDiv.trigger("chosen:updated");
                }
            }
        });
    }

    countryDiv.chosen({
        disable_search_threshold: 10,
        no_results_text: 'Oops, nothing found!',
        width: "100%"
    });
    cityDiv.chosen({
        disable_search_threshold: 10,
        no_results_text: 'Oops, nothing found!',
        width: "100%"
    });
    countryDiv.chosen().change(function () {
//        console.log();
        country_id = $(this).val();
        select = cityDiv;
        updateCities();
    });
}