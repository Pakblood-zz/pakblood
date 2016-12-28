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

    public function getCities()
    {
        $cities = City::get();

        return \Response::json(compact('cities'), 200);
    }
}
