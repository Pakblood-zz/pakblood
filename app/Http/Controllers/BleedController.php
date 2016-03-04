<?php

namespace App\Http\Controllers;

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
        $bleed = new Bleed;
        $bleed->user_id = Auth::user()->id;
        $bleed->receiver_name = $request->input('receiver_name');
        $bleed->city = $request->input('city');
        $bleed->comments = $request->input('comments');
        $bleed->date = date('Y-m-d', strtotime($request->input('date')));
        $user = Auth::user();
        $date1 = new Carbon($user->last_bleed);
        $date2 = new Carbon($request->input('date'));
        $diff = $date1->diff($date2);

        if ($bleed->save()) {
            if ($diff->invert == 0) {
                $user->last_bleed = date('Y-m-d', strtotime($request->input('date')));
                $user->save();
            }
            $data = [
                'email' => $user->email,
                'name'  => $user->name
            ];
            Mail::send(['html' => 'emails/bleed_status_updated'], $data, function ($message) use ($data) {
                $message
                    ->to($data['email'], $data['name'])
                    ->subject('Bleed Status Updated');
            });
            return Redirect::to('profile/' . Auth::user()->username)->with('message', 'Bleed Status Successfully Updated!!');
        }
        return Redirect::to('profile/' . Auth::user()->username)->with('message', 'There was some problems updating bleed status');
    }
}
