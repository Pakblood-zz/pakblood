<?php

namespace App\Http\Controllers;

use App\Bleed;
use App\City;
use App\Org;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller {

    public $bloodGroupArray
        = [
            'Ap' => 'A+',
            'An' => 'A-',
            'Bp' => 'B+',
            'Bn' => 'B-',
            'Op' => 'O+',
            'On' => 'O-',
            'ABp' => 'AB+',
            'ABn' => 'AB-',
        ];

    public function hashPassword() {
        /*$user = User::where('id', 1)->first();
        $user->password = bcrypt($user->password);
        $user->save();*/
        /*$bloodGroupArray = [
            'A+'  => 'Ap',
            'A-'  => 'An',
            'B+'  => 'Bp',
            'B-'  => 'Bn',
            'O+'  => 'Op',
            'O-'  => 'On',
            'AB+' => 'ABp',
            'AB-' => 'ABn'
        ];*/
        /*$users = User::where('id', '!=', 1)->skip(900)->take(450)->get();
        foreach ($users as $user) {
//            dd($user->id);
//            dump($user->password);
//            $user->blood_group = (array_key_exists($user->blood_group, $bloodGroupArray)) ? $bloodGroupArray[$user->blood_group] : '';
//            $user->password = bcrypt($user->password);
            $user->save();
//            dump($user->password);
        }*/
    }

    public function getProfile() {
        $user               = User::find(Auth::user()->id);
        $user['gender']     = ($user->gender == '') ? "N/A" : (($user->gender == 'm') ? "Male" : "Female");
        $user['country_id'] = City::where('id', $user->city_id)->pluck('country_id');
        $user['city']       = City::where('id', $user->city_id)->pluck('name');
        $user['org']        = Org::where('id', $user->org_id)->pluck('name');
        $user['bg']         = (array_key_exists($user->blood_group,
            $this->bloodGroupArray)) ? $this->bloodGroupArray[$user->blood_group] : '';
        $data               = [
            'bleed' => Bleed::select('*')->where('user_id', '=', Auth::user()->id)->orderBy('date', 'DESC')->get(),
            'user' => $user,
            'cities' => City::where('country_id', $user->country_id)->get(),
        ];
        return view('profile', $data);
    }

    public function updateProfile(Request $request) {
        //        dd($request->input());
        $redirectId = (Auth::user()->username != '') ? Auth::user()->username : Auth::user()->id;
        $user       = User::where('id', '=', Auth::user()->id)->first();
        $user->name = $request->input('name');
        if (($request->input('username') != '') && count(User::where('username',
                $request->input('username'))->where('id', '!=',
                Auth::user()->id)->get()) > 0
        ) {
            return Redirect::to('profile/' . $redirectId)->with('message', 'Username already exists.')->with('type',
                'error');
        }
        $user->username    = $request->input('username');
        $user->email       = $request->input('email');
        $user->gender      = $request->input('gender');
        $user->dob         = date('Y-m-d', strtotime($request->input('dob')));
        $user->phone       = $request->input('phone');
        $user->mobile      = $request->input('mobile');
        $user->address     = $request->input('address');
        $user->city_id     = $request->input('city');
        $user->blood_group = $request->input('bgroup');
        if ($user->save()) {
            $data = [
                'email' => $user->email,
                'name' => $user->name,
            ];
            if (\Config::get('settings.environment') == 'production') {
                Mail::send(['html' => 'emails/profile_updated'], $data, function ($message) use ($data) {
                    $message
                        ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                        ->subject('Pakblood Profile Updated');
                });
            }
            return Redirect::to('profile/' . $redirectId)->with('message',
                'Profile Successfully Updated!!')->with('type',
                'success');
        }
        return Redirect::to('profile/' . $redirectId)->with('message',
            'There was some Problems Saving Your profile please try again.')->with('type',
            'error');
    }

    /**
     * User delete
     */
    public function deleteUser(Request $request) {
        //        dd($request->input('feedback'));
        $org = Org::where('user_id', '=', Auth::user()->id)->first();
        if ($org != NULL) {
            return Redirect::to('profile/' . Auth::user()->username)->with('message',
                'Error!! can\'t delete your account until you\'r admin of an Organization,Please change admin of your organization to someone else and try again.')->with('type',
                'error');
        }
        $user             = User::where('id', '=', Auth::user()->id)->first();
        $user->is_deleted = '1';
        $user->save();
        $data = [
            'name' => $user->name,
            'reason' => $request->input('feedback'),
        ];
        Mail::queue('emails/unjoin', $data, function ($message) use ($user) {
            $message
                ->to($user->email, $user->name)->cc('info@pakblood.com')
                ->subject('Account Deactivated');
        });
        Auth::logout();
        return Redirect::to('/');
    }

    public function changePassword(Request $request) {
        //        dd($request->input());
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules     = array(
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('profile/' . Auth::user()->username . '#fndtn-changepassword')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $user = User::find(Auth::user()->id);
            if (\Hash::check($request->input('old_password'), $user->password)) {
                $user->password = bcrypt($request->input('new_password'));
                if ($user->save()) {
                    $data = [
                        'email' => $user->email,
                        'name' => $user->name,
                    ];
                    if (\Config::get('settings.environment') == 'production') {
                        Mail::send(['html' => 'emails/password_changed'], $data, function ($message) use ($data) {
                            $message
                                ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                                ->subject('Password Changed');
                        });
                    }
                    Auth::logout();
                    return Redirect::to('/login')
                        ->with('message',
                            'Password Successfully Change.Please login again with your new password.')->with('type',
                            'success');
                }
            }
            return Redirect::to('profile/' . Auth::user()->username . '#fndtn-changepassword')
                ->with('message', 'Old Password does not match.')->with('type', 'error');
        }
    }

    /*
     * activate delted users account
     * */

    public function activateAccount(Request $request) {
        $rules     = array(
            'email' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with(Input::all());
        }
        $pass = str_random(15);
        $user = User::where('email', '=', $request->input('email'))->first();
        if (count($user) > 0) {
            $user->is_deleted = '0';
            $user->status     = 'active';
            $user->password   = bcrypt($pass);
            $data             = array('name' => $user->name, 'email' => $user->email, 'password' => $pass);
            if ($user->save()) {
                Mail::queue('emails/rejoin', $data, function ($message) use ($user) {
                    $message
                        ->to($user->email, $user->name)->cc('info@pakblood.com')
                        ->subject('Account Activated');
                });
                return redirect()->back()->with('message',
                    'Your account information has been sent to your email, please follow the instruction in email to activate your account.')
                    ->with('type', 'success');
            }
        }
        return redirect()->back()->with(Input::all())->with('message', 'We could not find your email in our records.')
            ->with('type', 'error');
    }

    /**
     * @param $type
     * @return Redirect
     */
    function linkAccount($type) {
        if ($type == 'fb') {
            \Session::set('redirect', '/fblogin');
            \Session::set('userAccountId', \Auth::user()->id);
            return redirect('/logout');
        } else if ($type == 'gp') {
            \Session::set('redirect', '/gplogin');
            \Session::set('userAccountId', \Auth::user()->id);
            return redirect('/logout');
        }
        \Session::set('redirect', '/login');
        \Session::set('userAccountId', 0);
        return redirect('/logout');
    }

    /**
     * Unlink social accounts.
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    function unlinkAccount($type) {
        //        dd($type);
        $user     = User::find(\Auth::user()->id);
        $redirect = ($user->username) ? $user->username : $user->id;
        if ($type == 'fb') {
            $user->fb_id = NULL;
            $user->save();
            return redirect('/profile/' . $redirect)->with('message',
                'Facebook Account Successfully Unlinked.')->with('type',
                'success');
        } else if ($type == 'gp') {
            $user->gp_id = NULL;
            $user->save();
            return redirect('/profile/' . $redirect)->with('message',
                'Google+ Account Successfully Unlinked.')->with('type',
                'success');
        }
        return redirect()->back();
    }
}
