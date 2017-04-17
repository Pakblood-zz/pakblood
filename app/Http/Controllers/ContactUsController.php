<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller {

    public function sendMail(Request $request) {
        $data = Input::all();
        //        dd($data);
        $rules     = [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'country' => 'required',
            'city' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::to('/contact')->withInput()->withErrors($validator);
        } else {
            $data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'country' => Country::where('id', $data['country'])->pluck('short_name'),
                'city' => City::where('id', $data['city'])->pluck('name'),
                'msg' => $data['message'],
            ];
            if (\Config::get('settings.environment') == 'production') {
                $mail = Mail::send(['html' => 'emails/contact_us'], $data, function ($message) use ($data) {
                    $message
                        ->to('info@pakblood.com', 'Pakblood Team')
                        ->subject($data['subject']);
                });
            }
            if ($mail) {
                return redirect()->back()->with('message', 'Email has been sent. we will get in touch with you as soon as we can')
                    ->with('type', 'success');
            }
            //            dump($mail);
        }
        return redirect()->back()->with('message', 'There was some error please try again later.')
            ->with('type', 'error');
    }

    public function bulkEmail() {
        /*for ($i = 0; $i < 3; $i++) {
            $data = [
                'name'  => 'Asad Zaheer',
                'email' => 'asad.zaheer@aalasolutions.com'
            ];
            $mail = Mail::send(['html' => 'emails/bulkEmail'], $data, function ($message) use ($data) {
                $message
                    ->to($data['email'], $data['name'])
                    ->subject('Pakblood Site Updates.');
            });
            if ($mail) {
                dump("sent");
            }
        }
        dd(1);*/
        $array = [];
        $users = User::where('email', 'LIKE', '%_@__%.__%')->where('email_sent', '!=', 1)->orderBy('id')->skip(0)->take(100)->get();
        //        $users = User::where('email', 'asad.zaheer@aalasolutions.com')->where('email_sent', '!=', 1)->orderBy('id')->get();
        /*foreach ($users as $user) {
            array_push($array, ['name' => $user->name, 'email' => $user->email]);
        }
//        dump($array);
        for ($i = 0; $i < sizeof($array); $i++) {
            $data = [
                'name'  => $array[$i]['name'],
                'email' => $array[$i]['email'],
            ];
            $mail = Mail::send(['html' => 'emails/bulkEmail'], $data, function ($message) use ($data) {
                $message
                    ->to($data['email'], $data['name'])
                    ->subject('Pakblood Site Updates.');
            });
            if ($mail) {
                dump($array[$i]['name'] . ' => ' . $array[$i]['email']);
            }
        }*/
        //       dd($users);
        foreach ($users as $user) {
            $data = [
                'name' => $user->name,
                'email' => $user->email,
            ];
            if (\Config::get('settings.environment') == 'production') {
                $mail = Mail::send(['html' => 'emails/bulkEmail'], $data, function ($message) use ($data) {
                    $message
                        ->to($data['email'], $data['name'])
                        ->subject('Pakblood Site Updates.');
                });
            }
            if ($mail) {
                User::where('id', $user->id)->update(['email_sent' => 1]);
                dump("Mail Sent To : " . $user->id . " : " . $user->email);
            }
        }
    }
}
