<?php

namespace App\Http\Controllers;

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
        $rules = array(
            'name'                 => 'required',
            'email'                => 'required|email',
            'subject'              => 'required',
            'g-recaptcha-response' => 'required|captcha',
            'message'              => 'required',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::to('/contact')->withInput()->withErrors($validator);
        }
        else {
            $data = array('name' => $request->name, 'email' => $request->email, 'subject' => $request->subject
            , 'msg'              => $request->message,);
            $mail = Mail::send(['html' => 'emails/contact_us'], $data, function ($message) use ($data) {
                $message
                    ->to('info@pakblood.com', 'Pakblood Team')
                    ->subject($data['subject']);
            });
            if ($mail) {
                return redirect()->back()->with('message', 'Email has been sent. we will get in touch with you as soon as we can')
                    ->with('type', 'success');
            }
            dump($mail);
        }

    }
}
