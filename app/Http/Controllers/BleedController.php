<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bleed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\User;

class BleedController extends Controller {

    public function update(Request $request) {
        $country = Country::find($request->input('country'));
        $city    = City::find($request->input('city'));

        $bleed                = new Bleed;
        $bleed->user_id       = Auth::user()->id;
        $bleed->receiver_name = $request->input('receiver_name');
        $bleed->country       = $country->short_name;
        $bleed->city          = $city->name;
        $bleed->comment       = $request->input('comment');
        $bleed->from_pakblood = ($request->input('from_pakblood')) ? 1 : 0;
        $bleed->date          = date('Y-m-d', strtotime($request->input('date')));
        $user                 = Auth::user();
        $date1                = new Carbon($user->last_bleed);
        $date2                = new Carbon($request->input('date'));
        $diff                 = $date1->diff($date2);
        $redirect             = (Auth::user()->username != '') ? Auth::user()->username : Auth::user()->id;

        if ($bleed->save()) {
            if ($request->file('image') && $request->file('image') != null) {
                $img = uniqid(Auth::user()->id . '_' . $bleed->id . '_') . '.' .
                    $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(
                    base_path() . '/public/images/users/bleed/', $img
                );
                $path   = '/images/users/bleed/' . $img;
                $newImg = \Image::make(public_path($path));
                $newImg->insert(public_path('/images/PAKblood.png'), 'bottom-right', 10, 10);
                $newImg->save(public_path($path));

                $bleed->image = $path;
                $bleed->save();
            }
            if ($diff->invert == 0) {
                $user->last_bleed = date('Y-m-d', strtotime($request->input('date')));
                $user->save();
            }
            $data = [
                'email' => $user->email,
                'name' => $user->name
            ];
            if (\Config::get('settings.environment') == 'production') {
                Mail::send(['html' => 'emails/bleed_status_updated'], $data, function ($message) use ($data) {
                    $message
                        ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                        ->subject('Bleed Status Updated');
                });
            }
            return Redirect::to('profile/' . $redirect)->with('message', 'Bleed Status Successfully Updated!!');
        }
        return Redirect::to('profile/' . $redirect)->with('message', 'There was some problems updating bleed status');
    }

}
