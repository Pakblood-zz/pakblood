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

    public function getCountries()
    {
        $countries = Country::get();

        return \Response::json(compact('countries'), 200);
    }

    public function getCities(Request $request)
    {
        $cities = City::get();
        if ($request->input('country_id') != null) {
            $cities = City::where('country_id', $request->input('country_id'))->get();
        }
        return \Response::json(compact('cities'), 200);
    }
}
