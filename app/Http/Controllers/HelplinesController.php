<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpline;

class HelplinesController extends Controller {
    public function index() {
        $data = [
            'dirs' => Helpline::select('*')->paginate(15),
            'city' => ''
        ];
        return view('helplines', $data);
    }

    public function filterData(Request $request) {
        $data = [
            'dirs'     => Helpline::select('*')->where('city_id', '=', $request->city)->paginate(15),
            'hCountry' => $request->country,
            'hCities'  => City::where('country_id', $request->country)->get(),
            'hCity'    => $request->city,
        ];
        return view('helplines', $data);
    }
}
