<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * @param $request
     *
     * @return bool
     */
    public function checkUserExist(Request $request)
    {
        $field = $request->input('field');
        $val = $request->input('value');
//        dump($field);
//        dump($val);
        try {
            $data = User::where($field, $val)->get();
        } catch (\Exception $e) {
            return ['status' => -1, 'responseMessage' => $e->getMessage()];
        }

        if (count($data) == 0) {
            return ['status' => 0, 'responseMessage' => 'not found'];
        }
        return ['status' => 1, 'responseMessage' => 'record found'];
    }

    public function getCountryCallingCode($countryId)
    {
        $code = Country::where('id', $countryId)->pluck('calling_code');
        $code = explode(',', $code);
        return ['status' => 1, 'responseData' => $code];
    }
}
