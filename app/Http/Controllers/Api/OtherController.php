<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Country;
use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OtherController extends Controller
{
    /**
     * Get list of all countries
     * @return mixed
     */
    public function getCountries()
    {
        $countries = Country::get();

        return \Response::json([
                                   'countries'    => $countries,
                                   'responseCode' => 1
                               ], 200);
    }

    /**
     * Get list of all cities, if country id is provided then get list of cities in that country
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $cities = City::get();
        if ($request->input('country_id') != null) {
            $cities = City::where('country_id', $request->input('country_id'))->get();
        }
        return \Response::json([
                                   'cities'       => $cities,
                                   'responseCode' => 1
                               ], 200);
    }
}
