<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Country;
use App\Notification;
use Illuminate\Http\Request;
use App\User;

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

    public function uploadFile() {
        $input = \Input::json();
        if (\Auth::guest()) {
            return \Response::json([
                'responseCode' => -2,
                'responseMessage' => 'You need to be logedin to perform this action.'
            ], 200);
        } else {
            $user = User::find(\Auth::user()->id);

            if ($input->get('profile_image') && $input->get('profile_image') != null) {
                $base64_str = substr($input->get('profile_image'), strpos($input->get('profile_image'), ",") + 1);
                $image      = base64_decode($base64_str);
                $imageName  = uniqid($user->id . '_') . '.png';
                $path       = public_path('images/users/' . $imageName);
                \Image::make($image)->save($path);
                $user->profile_image = 'public/images/users/' . $imageName;
                $user->save();
                return \Response::json([
                    'responseCode' => 1,
                    'responseMessage' => 'Image Updated Successfully.',
                    'profile_image' => $user->profile_image
                ], 200);
                //                $request->file('profile_image')->move(
                //                    base_path() . '/public/images/users/', $img
                //                );
                //                $user->profile_image = '/images/users/' . $img;
                //                $user->save();
            }
        }
    }
}
