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
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller {
    /**
     * Login user
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function login(Request $request) {
        //        dd($request->input());
        //        dd(\Input::json());
        $email    = $request->input('email');
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
            $id   = \Auth::user()->id;
            $user = User::find($id);

            $access_token = \JWTAuth::fromUser($user);
            $expires_in   = \JWTAuth::getPayload($access_token)->get('exp');
            $token_type   = 'bearer';

            $newUser = new User;
            if (!($newUser->accountIsActive($user->email))) {
                return \Response::json([
                    'responseMessage' => 'Account Not Activated, you need to activate your account before login.',
                    'responseCode' => -6
                ],
                    400);
            } elseif ($newUser->isDeleted($user->email)) {
                return \Response::json([
                    'responseMessage' => 'Account is deleted.',
                    'responseCode' => -1
                ],
                    400);
            }
            $responseCode = 1;
            return \Response::json(compact('access_token', 'token_type', 'expires_in', 'user', 'provider',
                'responseCode'), 200);

        } else {
            $responseMessage = 'These credentials do not match our records.';
            $responseCode    = -4;
            return \Response::json(compact('responseMessage', 'responseCode'), 400);
        }

    }

    /**
     * Register User
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function register(Request $request) {
        $input = \Input::json();
        $data  = $input->get('user');
        if ($data == null) {
            return \Response::json([
                'responseMessage' => 'No data provided.',
                'responseCode' => -3
            ], 400);
        }
        $user = new User;
        if ($user->hasUser($data['email'])) {
            return \Response::json([
                'responseMessage' => 'Email Already Exists.',
                'responseCode' => -2
            ], 400);
        }
        $data['password'] = bcrypt($data['password']);
        $data['status']   = 'active';
        //        $confirmation_code = str_random(60);
        //        $data['confirmation_code'] = $confirmation_code;
        if (User::create($data)) {
            //            \Mail::queue('emails/email_verify', $data, function ($message) use ($user) {
            //                $message
            //                    ->to($user->email, $user->username)->cc('info@pakblood.com')
            //                    ->replyTo('info@pakblood.com')
            //                    ->subject('Verification Email');
            //            });
            //            \Mail::queue('emails/user_registered', $data, function ($message) use ($user) {
            //                $message
            //                    ->to('info@pakblood.com')
            //                    ->subject('New User Registered');
            //            });
            $name = (isset($data['name']) ? $data['name'] : null);
            if (\Config::get('settings.environment') == 'production') {
                try {
                    \Mail::queue('emails/welcome', ['name' => $name], function ($message) use ($user) {
                        $message
                            ->to($user->email)->cc('info@pakblood.com')
                            ->replyTo('info@pakblood.com')
                            ->subject('Verification Email');
                    });
                } catch (\Exception $e) {
                    return \Response::json([
                        'responseMessage' => 'Fail to send email, Invalid email',
                        'errorMessage' => $e->getMessage(),
                        'errorCode' => $e->getCode(),
                        'responseCode' => -2
                    ], 400);
                }
                //                \Mail::queue('emails/welcome', ['name' => $name], function ($message) use ($user) {
                //                    $message
                //                        ->to('info@pakblood.com')
                //                        ->subject('New User Registered');
                //                });
            }
            $msg = 'User is created successfully!';
            return \Response::json([
                'responseMessage' => $msg,
                'responseCode' => 1
            ], 200);
        } else {
            $msg = 'Error: Sorry! User could not be created!';
            return \Response::json([
                'responseMessage' => $msg,
                'responseCode' => -2
            ], 400);
        }

        //        return \Response::json(['response' => $msg], 200);
    }

    /**
     * Logout User
     * @return mixed
     */
    public function logout() {
        if (\Auth::guest()) {
            return \Response::json([
                'responseMessage' => 'Error! User not logedin.',
                'responseCode' => -5
            ], 400);
        }

        $token = JWTAuth::invalidate(JWTAuth::getToken());

        if ($token) {
            \Auth::logout();
            return \Response::json([
                'responseMessage' => 'User successfully logout.',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'Error! while trying to logout please try again.',
            'responseCode' => -2
        ], 400);
    }

    /**
     * Refresh user jwtauth token
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        $tokenOld = JWTAuth::getToken();

        $error = false;
        try {
            $access_token = \JWTAuth::refresh($tokenOld);
            $expires_in   = \JWTAuth::getPayload($access_token)->get('exp');
            $token_type   = 'bearer';
        } catch (TokenInvalidException $e) {
            return response()->json([
                'responseMessage' => 'Token Invalid',
                'responseCode' => -2
            ], $e->getStatusCode());
        } catch (TokenExpiredException $e) {
            return response()->json([
                'responseMessage' => 'Token Expired',
                'responseCode' => -2
            ], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json([
                'responseMessage' => 'Token Absent',
                'responseCode' => -2
            ], $e->getStatusCode());

        }

        if ($error) {
            return \Response::json([
                'responseMessage' => 'Token not valid',
                'responseCode' => -2
            ], 400);
        } else {
            return \Response::json([
                'access_token' => $access_token,
                'expires_in' => $expires_in,
                'token_type' => $token_type,
                'responseCode' => 1
            ], 200);
        }

    }

    /**
     * Get user profile details
     * @return mixed
     */
    public function getProfile() {
        if (\Auth::user()) {
            return \Response::json([
                'user' => \Auth::user(),
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'You need to be logedin for this',
            'responseCode' => -5
        ], 400);
    }

    /**
     * Update user profile details
     * @return mixed
     */
    public function update() {
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
                return \Response::json([
                    'responseMessage' => 'Profile Successfully Updated.',
                    'responseCode' => 1
                ], 200);
            }
            return \Response::json([
                'responseMessage' => 'Problem with updating user profile.',
                'responseCode' => -1
            ], 400);
        }

        return \Response::json([
            'responseMessage' => 'Error! User not found.',
            'responseCode' => -4
        ], 400);
    }

    /**
     * Reset user password
     * @return mixed
     */
    public function resetPassword() {
        $input = \Input::json();

        $user = User::find(\Auth::user()->id);
        if (count($user) == 0) {
            return \Response::json([
                'responseMessage' => 'Error! user not found.',
                'responseCode' => -4
            ], 400);
        }
        $data = $input->get('user');

        if (\Hash::check($data['old_password'], $user->password)) {
            $user->update(['password' => bcrypt($data['new_password'])]);
            if ($user->save()) {
                $this->addNotification('Password Reset.');
                return \Response::json([
                    'responseMessage' => 'Password Updated.',
                    'responseCode' => 1
                ], 200);
            }
            return \Response::json([
                'responseMessage' => 'Error! updating Password.',
                'responseCode' => -1
            ], 400);
        }

        return \Response::json([
            'responseMessage' => 'Old Password Does Not Match.',
            'responseCode' => -1
        ], 400);
    }

    /**
     * Get user bleed history
     * @return mixed
     */
    public function bleedHistory() {
        $data = Bleed::where('user_id', \Auth::user()->id)->orderBy('date', 'DESC')->get();

        return \Response::json([
            'data' => $data,
            'responseCode' => 1
        ], 200);
    }

    /**
     * Create user bleed details
     * @return mixed
     */
    public function createBleed() {
        $input = \Input::json();

        $bleed                = new Bleed();
        $bleed->user_id       = \Auth::user()->id;
        $bleed->receiver_name = $input->get('receiver_name');
        $bleed->city          = $input->get('city');
        $bleed->comments      = $input->get('comments');
        $bleed->date          = $input->get('date');
        if ($bleed->save()) {
            $latestBleed = Bleed::where('user_id', \Auth::user()->id)->orderBy('date', 'DESC')->first();
            $user        = User::find(\Auth::user()->id);
            if (count($user) == 0) {
                return \Response::json([
                    'responseMessage' => 'Error! user not found.',
                    'responseCode' => -4
                ], 400);
            }
            $user->last_bleed = $latestBleed->date;
            $user->save();
            $this->addNotification('Bleed Status Added.');
            return \Response::json([
                'responseMessage' => 'User bleed status added.',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'Error! Adding user bleed status.',
            'responseCode' => -2
        ], 400);
    }

    /**
     * Update user bleed details
     *
     * @param $bleedId
     *
     * @return mixed
     */
    public function updateBleed($bleedId) {
        $input = \Input::json();

        $bleed = Bleed::where('user_id', \Auth::user()->id)->where('id', $bleedId)->first();
        if ($bleed) {
            $bleed->receiver_name = $input->get('receiver_name');
            $bleed->city          = $input->get('city');
            $bleed->comments      = $input->get('comments');
            $bleed->date          = $input->get('date');
            if ($bleed->save()) {
                $latestBleed      = Bleed::where('user_id', \Auth::user()->id)->orderBy('date', 'DESC')->first();
                $user             = User::find(\Auth::user()->id);
                $user->last_bleed = $latestBleed->date;
                $user->save();
                $this->addNotification('Bleed Status Updated.');
                return \Response::json([
                    'responseMessage' => 'User bleed status updated.',
                    'responseCode' => 1
                ], 200);
            }
            return \Response::json([
                'responseMessage' => 'Error! Updating user bleed status.',
                'responseCode' => -1
            ], 400);
        }
        return \Response::json([
            'responseMessage' => 'Error! User bleed record not found.',
            'responseCode' => -4
        ], 400);
    }

    /**
     * Deactivate user account
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function deactivateAccount(Request $request) {
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
                return \Response::json([
                    'responseMessage' => 'User account deactivated.',
                    'responseCode' => 1
                ], 200);
            }
        }
        return \Response::json([
            'responseMessage' => 'Error! User not found.',
            'responseCode' => -4
        ], 400);
    }

    /**
     * Activate user account
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function activateAccount(Request $request) {
        $input = \Input::json();

        $pass = str_random(15);
        $user = User::where('email', $input->get('email'))->first();
        if (count($user) > 0) {
            //            $user->is_deleted = '0';
            $user->status   = 'active';
            $user->password = bcrypt($pass);
            $data           = array('name' => $user->name, 'email' => $user->email, 'password' => $pass);
            if ($user->save()) {
                $this->addNotification('Account activated.');
                \Mail::queue('emails/rejoin', $data, function ($message) use ($user) {
                    $message
                        ->to($user->email, $user->name)->cc('info@pakblood.com')
                        ->replyTo('info@pakblood.com', 'Pakblood Team')
                        ->subject('Account Activated');
                });
                return \Response::json([
                    'responseMessage' => 'Account activation details sent to email, please follow the process to access account.',
                    'responseCode' => 1
                ],
                    200);
            }
            return \Response::json([
                'responseMessage' => 'Error! Activating user account, please try again.',
                'responseCode' => -2
            ], 400);
        }
        return \Response::json([
            'responseMessage' => 'Error! User not found.',
            'responseCode' => -4
        ], 400);
    }

    /**
     * Change user password
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function changePassword(Request $request) {
        $input = \Input::json();

        $user = User::find(\Auth::user()->id);
        if (\Hash::check($input->get('old_password'), $user->password)) {
            $user->password = bcrypt($input->get('new_password'));
            if ($user->save()) {
                $this->addNotification('Password Updated.');
                $data = [
                    'email' => $user->email,
                    'name' => $user->name,
                ];
                \Mail::send(['html' => 'emails/password_changed'], $data, function ($message) use ($data) {
                    $message
                        ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                        ->replyTo('info@pakblood.com', 'Pakblood Team')
                        ->subject('Password Changed');
                });
                \Auth::logout();
                return \Response::json([
                    'responseMessage' => 'Password Successfully Change.Please login again with your new password.',
                    'responseCode' => 1
                ],
                    200);
            }
        }
        return \Response::json([
            'responseMessage' => 'Old password does not match.',
            'responseCode' => -1
        ], 400);
    }

    /**
     * Report user
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function reportUser(Request $request) {
        $input = \Input::json();

        if (\Auth::user()) {
            $report = Report::whereReported_user_idAndReporter_user_id($input->get('reported_user_id'),
                \Auth::user()->id)->first();
            if (count($report) > 0) {
                return \Response::json([
                    'responseMessage' => 'You have already reported that user, please wait for our admin team to review your report.',
                    'responseCode' => -2
                ],
                    400);
            }
            $reporter = [
                'name' => \Auth::user()->name,
                'email' => \Auth::user()->email,
            ];
        } else {
            $report = Report::whereReported_user_idAndReporter_user_ip($input->get('reported_user_id'),
                \Request::ip())->first();
            if (count($report) > 0) {
                return \Response::json([
                    'responseMessage' => 'You have already reported that user, please wait for our admin team to review your report',
                    'responseCode' => -2
                ],
                    400);
            }
            $reporter = [
                'name' => $input->get('name'),
                'email' => $input->get('email'),
            ];
        }
        $report                   = new Report;
        $report->reported_user_id = $input->get('reported_user_id');
        if (\Auth::user()) {
            $report->reporter_user_id = \Auth::user()->id;
        } else {
            $report->reporter_user_ip = \Request::ip();
        }
        $report->reporter_name    = $reporter['name'];
        $report->reporter_email   = $reporter['email'];
        $report->type             = $input->get('report_type');
        $report->reporter_message = $input->get('comments');
        //        dump($request->input());
        $user = User::find($input->get('reported_user_id'));
        //        dd($user);
        if ($report->save()) {
            $data = [
                'email' => $user->email,
                'name' => $user->name,
                'reason' => $input->get('report_type'),
                'msg' => $input->get('comments')
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
            return \Response::json([
                'responseMessage' => 'User successfully reported.',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'There was some problems reporting user please try again.',
            'responseCode' => -1
        ], 400);
    }

    /**
     * Update user current location
     * @return mixed
     */
    public function currentLocation() {
        $input = \Input::json();

        if (\Auth::guest()) {
            return \Response::json([
                'responseMessage' => 'No user currently logedin.',
                'responseCode' => -5
            ], 400);
        }

        $user            = User::find(\Auth::user()->id);
        $user->latitude  = $input->get('latitude');
        $user->longitude = $input->get('longitude');
        if ($user->save()) {
            return \Response::json([
                'responseMessage' => 'User location updated.',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'Error! Updating user location.',
            'responseCode' => -2
        ], 400);
    }

    /**
     * Get user notifications
     * @return mixed
     */
    public function getNotifications() {
        if (\Auth::guest()) {
            return \Response::json([
                'responseMessage' => 'User not logedin.',
                'responseCode' => -5
            ], 200);
        }
        $notifications = Notification::where('user_id', \Auth::user()->id)->get();

        return \Response::json([
            'notifications' => $notifications,
            'responseCode' => 1
        ], 200);
    }

    /**
     * Add user notification
     *
     * @param $msg
     *
     * @return bool
     */
    public function addNotification($msg) {
        if (\Auth::guest()) {
            return \Response::json([
                'responseMessage' => 'User not logedin.',
                'responseCode' => -5
            ], 200);
        }

        $notification          = new Notification();
        $notification->user_id = \Auth::user()->id;
        $notification->message = $msg;

        if ($notification->save()) {
            return \Response::json([
                'responseMessage' => 'User notification added.',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'Error! while adding user notification.',
            'responseCode' => -2
        ], 400);
    }

    /**
     * Send user password reset email
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function forgotPassword(Request $request) {
        $input = \Input::json();
        //        dd($input->get('email'));
        if ($request->only('email') == null) {
            return \Response::json([
                'responseMessage' => 'Error! No email provided.',
                'responseCode' => -3
            ], 400);
        }
        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject('Your Password Reset Link');
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return \Response::json([
                    'responseMessage' => $response,
                    'responseCode' => 1
                ], 200);

            case Password::INVALID_USER:
                return \Response::json([
                    'responseMessage' => $response,
                    'responseCode' => -4
                ], 400);
        }
    }
}
