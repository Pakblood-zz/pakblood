<?php

namespace App\Http\Controllers\Api;

use App\Bleed;
use App\Notification;
use App\Report;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use JWTAuth;

class UserController extends Controller
{
    public function login(Request $request)
    {
//        dd($request->input());
        $email = $request->input('email');
        $password = ($request->input('password')) ? $request->input('password') : '';
        $provider = ($request->input('provider')) ? $request->input('provider') : 'default';
        if ($provider == 'facebook') {
            $name = $request->input('name');
            $user = User::where('email', $email)->first();
            if (count($user) == 0) {
                $newUser = User::create(['name' => $name, 'email' => $email]);
                //Login new created user by id here
                $user = \Auth::loginUsingId($newUser->id);
            } else {
                $user = \Auth::loginUsingId($user->id);
            }
        } else if ($provider == 'google') {
            $name = $request->input('name');
            $user = User::where('email', $email)->first();
            if (count($user) == 0) {
                $newUser = User::create(['name' => $name, 'email' => $email]);
                //Login new created user by id here
                $user = \Auth::loginUsingId($newUser->id);
            } else {
                $user = \Auth::loginUsingId($user->id);
            }
        } else {
            $user = \Auth::attempt(['email' => $email, 'password' => $password]);
        }

        if ($user) {
            $id = \Auth::user()->id;
            $user = User::find($id);

            $access_token = JWTAuth::fromUser($user);
            $expires_in = 10000;
            $token_type = 'bearer';

            $newUser = new User;
            if (!($newUser->accountIsActive($user->email))) {
                return \Response::json(['msg' => 'Account Not Activated, you need to activate your account before login.'],
                                       400);
            } elseif ($newUser->isDeleted($user->email)) {
                return \Response::json(['msg' => 'Account is deleted.'],
                                       400);
            }

            return \Response::json(compact('access_token', 'token_type', 'expires_in', 'user', 'provider'), 200);

        } else {
            $error = 'These credentials do not match our records.';

            return \Response::json(compact('error'), 400);
        }

    }

    public function register(Request $request)
    {
        $input = \Input::json();
        $data = $input->get('user');
        if ($data == null) {
            return \Response::json(['msg' => 'No data provided.'], 400);
        }
        $user = new User;
        if ($user->hasUser($data['email'])) {
            return \Response::json(['msg' => 'Email Already Exists.'], 400);
        }
        $data['password'] = bcrypt($data['password']);
        if (User::create($data)) {
            $msg = 'User is created successfully!';
        } else {
            $msg = 'Error: Sorry! User could not create!';
        }

        return \Response::json(['response' => $msg], 200);
    }

    public function logout()
    {
        if (\Auth::guest()) {
            return \Response::json(['msg' => 'error logout.user not logedin.'], 400);
        }

        $token = JWTAuth::invalidate(JWTAuth::getToken());

        if ($token) {
            \Auth::logout();
            return \Response::json(['msg' => 'user logout done.'], 200);
        }
        return \Response::json(['msg' => 'error logout.'], 400);
    }

    /**
     * Session check, if user is logged in or not
     */
    public function refresh()
    {
        $tokenOld = JWTAuth::getToken();

        $error = false;
        try {
            $access_token = JWTAuth::refresh($tokenOld);
        } catch (Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }

        if ($error) {
            return \Response::json(['Token not valid'], 400);
        } else {
            return \Response::json(compact('access_token'), 200);
        }

    }

    public function getProfile()
    {
        if (\Auth::user()) {
            return \Response::json(['user' => \Auth::user()], 200);
        }
        return \Response::json(['error' => 'You need to be logedin for this'], 400);
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $input = \Input::json();

        $user = User::find(\Auth::user()->id);

        $data = $input->get('user');
//        $data['password'] = bcrypt($data['password']);
//        unset($data['password']);
//        dd($data);
        if ($user) {
            $user->update($data);
//            $user->update(['name' => $data['name'], 'email' => $data['email']]);
            if ($user->save()) {
                $this->addNotification('Profile Successfully Updated.');
                return \Response::json(['message' => 'Profile Successfully Updated.'], 200);
            }
            return \Response::json(['message' => 'Problem with updating user profile.'], 400);
        }

        return \Response::json(['message' => 'Error!, while updating profile.'], 400);
    }

    /**
     * @return mixed
     */
    public function resetPassword()
    {
        $input = \Input::json();

        $user = User::find(\Auth::user()->id);

        $data = $input->get('user');

        if (\Hash::check($data['old_password'], $user->password)) {
            $user->update(['password' => bcrypt($data['new_password'])]);
            if ($user->save()) {
                $this->addNotification('Password Reset.');
                return \Response::json(['message' => 'Password Updated.'], 200);
            }
            return \Response::json(['message' => 'error updating Password.'], 400);
        }

        return \Response::json(['message' => 'Old Password Does Not Match.'], 200);
    }

    public function bleedHistory()
    {
        $data = Bleed::where('user_id', \Auth::user()->id)->orderBy('date', 'DESC')->get();

        return \Response::json(compact('data'), 200);
    }

    public function updateBleed($bleedId)
    {
        $input = \Input::json();

        $bleed = Bleed::where('user_id', \Auth::user()->id)->where('id', $bleedId)->first();
        if ($bleed) {
            $bleed->receiver_name = $input->get('receiver_name');
            $bleed->city = $input->get('city');
            $bleed->comments = $input->get('comments');
            $bleed->date = $input->get('date');
            if ($bleed->save()) {
                $latestBleed = Bleed::where('user_id', \Auth::user()->id)->orderBy('date', 'DESC')->first();
                $user = User::find(\Auth::user()->id);
                $user->last_bleed = $latestBleed->date;
                $user->save();
                $this->addNotification('Bleed Status Updated.');
                return \Response::json(['msg' => 'bleed updated.'], 200);
            }
            return \Response::json(['msg' => 'error updating bleed.'], 400);
        }
        return \Response::json(['msg' => 'error updating bleed.'], 400);
    }

    public function createBleed()
    {
        $input = \Input::json();

        $bleed = new Bleed();
        $bleed->user_id = \Auth::user()->id;
        $bleed->receiver_name = $input->get('receiver_name');
        $bleed->city = $input->get('city');
        $bleed->comments = $input->get('comments');
        $bleed->date = $input->get('date');
        if ($bleed->save()) {
            $latestBleed = Bleed::where('user_id', \Auth::user()->id)->orderBy('date', 'DESC')->first();
            $user = User::find(\Auth::user()->id);
            $user->last_bleed = $latestBleed->date;
            $user->save();
            $this->addNotification('Bleed Status Added.');
            return \Response::json(['msg' => 'bleed added.'], 200);
        }
        return \Response::json(['msg' => 'error adding bleed.'], 400);
    }

    public function deactivateAccount(Request $request)
    {
        $input = \Input::json();

        $user = User::where('email', \Auth::user()->email)->first();
        if (count($user) > 0) {
//            $user->is_deleted = '0';
            $user->status = 'inactive';
//            $user->password = bcrypt($pass);
            $data = array('name' => $user->name, 'email' => $user->email, 'reason' => $input->get('reason'));
            if ($user->save()) {
                \Mail::queue('emails/unjoin', $data, function ($message) use ($user) {
                    $message
                        ->to($user->email, $user->name)->cc('info@pakblood.com')
                        ->replyTo('info@pakblood.com', 'Pakblood Team')
                        ->subject('Account Deactivated');
                });
                return \Response::json(['msg' => 'account deactivated.'], 200);
            }
        }
        return \Response::json(['msg' => 'problem with deactivating account.'], 400);
    }

    public function activateAccount(Request $request)
    {
        $input = \Input::json();

        $pass = str_random(15);
        $user = User::where('email', $input->get('email'))->first();
        if (count($user) > 0) {
//            $user->is_deleted = '0';
            $user->status = 'active';
            $user->password = bcrypt($pass);
            $data = array('name' => $user->name, 'email' => $user->email, 'password' => $pass);
            if ($user->save()) {
                $this->addNotification('Account activated.');
                \Mail::queue('emails/rejoin', $data, function ($message) use ($user) {
                    $message
                        ->to($user->email, $user->name)->cc('info@pakblood.com')
                        ->replyTo('info@pakblood.com', 'Pakblood Team')
                        ->subject('Account Activated');
                });
                return \Response::json(['msg' => 'account activation details sent to email, please follow the process to access account.'],
                                       200);
            }
        }
        return \Response::json(['msg' => 'problem with activating account.'], 400);
    }

    public function changePassword(Request $request)
    {
        $input = \Input::json();

        $user = User::find(\Auth::user()->id);
        if (\Hash::check($input->get('old_password'), $user->password)) {
            $user->password = bcrypt($input->get('new_password'));
            if ($user->save()) {
                $this->addNotification('Password Updated.');
                $data = [
                    'email' => $user->email,
                    'name'  => $user->name,
                ];
                \Mail::send(['html' => 'emails/password_changed'], $data, function ($message) use ($data) {
                    $message
                        ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                        ->replyTo('info@pakblood.com', 'Pakblood Team')
                        ->subject('Password Changed');
                });
                \Auth::logout();
                return \Response::json(['msg' => 'Password Successfully Change.Please login again with your new password.'],
                                       200);
            }
        }
        return \Response::json(['msg' => 'Problem changing password.'], 400);
    }

    public function reportUser(Request $request)
    {
        $input = \Input::json();

        if (\Auth::user()) {
            $report = Report::whereReported_user_idAndReporter_user_id($input->get('reported_user_id'),
                                                                       \Auth::user()->id)->first();
            if (count($report) > 0) {
                return \Response::json(['msg' => 'You have already reported that user, please wait for our admin team to review your report'],
                                       400);
            }
            $reporter = [
                'name'  => \Auth::user()->name,
                'email' => \Auth::user()->email,
            ];
        } else {
            $report = Report::whereReported_user_idAndReporter_user_ip($input->get('reported_user_id'),
                                                                       \Request::ip())->first();
            if (count($report) > 0) {
                return \Response::json(['msg' => 'You have already reported that user, please wait for our admin team to review your report'],
                                       400);
            }
            $reporter = [
                'name'  => $input->get('name'),
                'email' => $input->get('email'),
            ];
        }
        $report = new Report;
        $report->reported_user_id = $input->get('reported_user_id');
        if (\Auth::user()) {
            $report->reporter_user_id = \Auth::user()->id;
        } else {
            $report->reporter_user_ip = \Request::ip();
        }
        $report->reporter_name = $reporter['name'];
        $report->reporter_email = $reporter['email'];
        $report->type = $input->get('report_type');
        $report->reporter_message = $input->get('comments');
//        dump($request->input());
        $user = User::find($input->get('reported_user_id'));
//        dd($user);
        if ($report->save()) {
            $data = [
                'email'  => $user->email,
                'name'   => $user->name,
                'reason' => $input->get('report_type'),
                'msg'    => $input->get('comments')
            ];
//            dump($data['msg']);
            \Mail::send(['html' => 'emails/user_reported'], $data, function ($message) use ($data) {
                $message
                    ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                    ->replyTo('info@pakblood.com', 'Pakblood Team')
                    ->subject('Account Reported.');
            });
            \Mail::send(['html' => 'emails/thank_you_for_reporting'], $reporter, function ($message) use ($reporter) {
                $message
                    ->to($reporter['email'], $reporter['name'])->cc('info@pakblood.com')
                    ->replyTo('info@pakblood.com', 'Pakblood Team')
                    ->subject('Thank you for reporting user on Pakblood.');
            });
            if (!\Auth::guest()) {
                $this->addNotification('User Reported.');
            }
            return \Response::json(['msg' => 'User successfully reported.'], 200);
        }
        return \Response::json(['msg' => 'There was some problems reporting user please try again.'], 400);
    }

    public function currentLocation()
    {
        $input = \Input::json();

        if (\Auth::guest()) {
            return \Response::json(['msg' => 'No user currently loged in.'], 400);
        }

        $user = User::find(\Auth::user()->id);
        $user->latitude = $input->get('latitude');
        $user->longitude = $input->get('longitude');
        if ($user->save()) {
            return \Response::json(['msg' => 'User location updated.'], 200);
        }
        return \Response::json(['msg' => 'Error updating user location.'], 400);
    }


    public function getNotifications()
    {
        if (\Auth::guest()) {
            return \Response::json(['msg' => 'User not loged in.'], 200);
        }
        $notifications = Notification::where('user_id', \Auth::user()->id)->get();

        return \Response::json(compact('notifications'), 200);
    }

    public function addNotification($msg)
    {
        if (\Auth::guest()) {
            return \Response::json(['msg' => 'User not loged in.'], 200);
        }

        $notification = new Notification();
        $notification->user_id = \Auth::user()->id;
        $notification->message = $msg;

        if ($notification->save()) {
            return true;
        }
        return false;
    }

    public function forgotPassword(Request $request)
    {
        $input = \Input::json();
//        dd($input->get('email'));
        if ($request->only('email') == null) {
            return \Response::json(['msg' => 'no email provided'], 400);
        }
        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject('Your Password Reset Link');
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return \Response::json(['msg' => $response], 200);

            case Password::INVALID_USER:
                return \Response::json(['msg' => $response], 400);
        }
    }
}
