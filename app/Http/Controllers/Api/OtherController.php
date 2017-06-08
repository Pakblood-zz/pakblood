<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Country;
use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OtherController extends Controller {
    /**
     * Get list of all countries
     * @return mixed
     */
    public function getCountries() {
        $countries = Country::get();

        return \Response::json([
            'countries' => $countries,
            'responseCode' => 1
        ], 200);
    }

    /**
     * Get list of all cities, if country id is provided then get list of cities in that country
     *
     * @param null $countryId
     * @return mixed
     */
    public function getCities($countryId = null) {
        $cities = City::get();
        if ($countryId != null) {
            $cities = City::where('country_id', $countryId)->get();
        }
        return \Response::json([
            'cities' => $cities,
            'responseCode' => 1
        ], 200);
    }

    public function sendErrorReport() {
        $input         = \Input::json();
        $data['error'] = $input->get('error');

        $mail = \Mail::send(['html' => 'emails/app_error'], $data, function ($message) {
            $message
                ->to('info@pakblood.com')
                ->cc('arslan.yasin@aalasolutions.com')
                ->subject('App Error Message');
        });
        if ($mail) {
            return \Response::json([
                'responseCode' => 1,
                'responseMessage' => 'error delivered successfully'
            ], 200);
        }
        return \Response::json([
            'responseCode' => -2,
            'responseMessage' => 'unexpected error wile sending mail'
        ], 200);
    }
}
