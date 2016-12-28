<?php

namespace App\Http\Controllers\Auth;

use App\City;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath        = '/';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }


    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return view('auth.login');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:pb_users',
            'email' => 'required|email|max:255|unique:pb_users',
            'password' => 'required|min:6|confirmed',
            'city' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */

    protected function create(array $data)
    {
        return User::create([
                                'name' => $data['name'],
                                'username' => $data['username'],
                                'email' => $data['email'],
                                'password' => bcrypt($data['password']),
                                'gender' => $data['gender'],
                                'dob' => $data['dob'],
                                'phone' => $data['phone'],
                                'address' => $data['address'],
                                'city_id' => $data['city_id'],
                                'status' => 'inactive'
                            ]);

    }

    /**
     * Create a new user and send verification email to activate account
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $confirmation_code = str_random(60);
        $user = new User;
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->gender = $request->input('gender');
        $user->dob = date('Y-m-d', strtotime($request->input('dob')));
        $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');
        $user->address = $request->input('address');
        $user->city_id = $request->input('city');
        $user->blood_group = $request->input('bgroup');
        $user->status = 'inactive';
        $user->confirmation_code = $confirmation_code;

        if ($user->save()) {
            $data = array(
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'gender' => $user->gender,
                'dob' => date('Y-m-d', strtotime($request->input('dob'))),
                'phone' => $user->phone,
                'mobile' => $user->mobile,
                'address' => $user->address,
                'city' => City::where('id', $user->city_id)->pluck('name'),
                'blood_group' => $user->blood_group,
                'status' => $user->status,
                'code' => $confirmation_code,
            );
            Mail::queue('emails/email_verify', $data, function ($message) use ($user) {
                $message
                    ->to(Input::get('email'), Input::get('username'))->cc('info@pakblood.com')
                    ->subject('Verification Email');
            });
            Mail::queue('emails/user_registered', $data, function ($message) use ($user) {
                $message
                    ->to('info@pakblood.com')
                    ->subject('New User Registered');
            });
            return redirect('account/verify');
        } else {
            Session::flash('message', 'Your account couldn\'t be created please try again');
            return redirect()->back()->withInput();
        }

    }

    /**
     * Activate user account after reciving confirmation code
     */
    public function activateAccount($code, User $user)
    {
        if ($user->ActivateAccount($code)) {
            $data = array(
                'name' => \Auth::user()->name,
                'email' => \Auth::user()->email
            );
            Mail::queue('emails/welcome', $data, function ($message) use ($data) {
                $message
                    ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                    ->subject('Welcome To Pakblood');
            });
            return redirect('account/verified');
        }
        Session::flash('message', 'Your account couldn\'t be activated, please try again');
        return redirect('/');
    }

    /**
     * check if user is active and registered
     */
    public function postLogin(Request $request)
    {
//        $credentials = $this->getCredentials($request);
//        $user = User::where('email', $request->input('email'))->first();
//        dump($user);
//        dump($request->input('email'));
//        dump($request->input('password'));
//        dump(\Hash::check($request->input('password'), $user->password));
//        dump(Auth::attempt($credentials, $request->has('remember')));
//        dd();
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        $credentials = $this->getCredentials($request);
        $user = new User;
        if ($user->hasUser($request->input('email'))) {
            if (!($user->accountIsActive($credentials['email']))) {
                return redirect($this->loginPath())
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->withErrors([
                                     "Account Not Activated, you need to activate your account before login.",
                                 ])
                    ->with(["activation_link" => "<a href='" . url('/account/activation') . "'>Activate Account Here</a>"]);

            } elseif ($user->isDeleted($request->input('email'))) {
                return redirect($this->loginPath())
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->with("message", "This account is deactivated.")
                    ->with('type', 'deactivated');
            }
        }
        if (Auth::attempt($credentials, $request->has('remember'))) {
            User::where('id', \Auth::user()->id)->update(['last_login' => Carbon::now()]);
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                             "Wrong Email or Password",
                         ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  bool $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        $redirectId = (Auth::user()->username != '') ? Auth::user()->username : Auth::user()->id;
//        return redirect('profile/' . $redirectId);
        if (Auth::user()->role == 'admin') {
            \Session::set('auth.type', 'admin');
            return redirect('/admin');
        } elseif (Auth::user()->role == 'user') {
            \Session::set('auth.type', 'user');
            return redirect('profile/' . $redirectId);
        }
        \Auth::logout();
        return redirect('/login')->with('message', 'Unauthorized.')->with('type', 'error');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function fbLoginCallback(Request $request)
    {

        $state = $request->get('state');
        $request->session()->put('state', $state);
        if (!\Session::get('state')) {
            return redirect($this->loginPath());
        }
//        dd($request);

        try {
//            var_dump(1);
            $user = \Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            //Here you can write excepion Handling Login
            return redirect($this->loginPath());
        }

//        $user = \Socialite::with('facebook')->user();
        $fb = true;
        $checkUser = new User();
//        dump($checkUser->isDeleted($user->email));
//        dd($checkUser);

        // Condition when user is linking his/her social account to pakblood account.
        if (\Session::get('userAccountId') && \Session::get('userAccountId') != 0) {
            $userAccount = User::find(\Session::get('userAccountId'));
            if ($userAccount && $userAccount->fb_id == null) {
                $userAccount->fb_id = $user->id;
                $userAccount->save();
                if (Auth::loginUsingId($userAccount->id)) {
                    User::where('id', \Auth::user()->id)->update(['last_login' => Carbon::now()]);
                    $data = array(
                        'name' => \Auth::user()->name,
                        'email' => \Auth::user()->email,
                        'fb_id' => $user->id
                    );
                    Mail::queue('emails/social_account_linked', $data, function ($message) use ($data) {
                        $message
                            ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                            ->subject('Facebook Account Linked');
                    });
                    $redirect = (Auth::user()->username) ? Auth::user()->username : Auth::user()->id;
                    return redirect('profile/' . $redirect);
                }
            }
            \Session::set('userAccountId', 0);
        }
        // If user social email exists in pakblood db.
        $userEmailFound = User::where('email', $user->email)->first();
        if ($userEmailFound) {
            if ($checkUser->isDeleted($user->email)) {
                return redirect($this->loginPath())
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->with("message", "This is account is deactivated.")
                    ->with('type', 'deactivated');
            }
            //If user Facebook id matches with Socialite result id
            if ($userEmailFound->fb_id == $user->id) {
                if (Auth::loginUsingId($userEmailFound->id)) {
                    User::where('id', \Auth::user()->id)->update(['last_login' => Carbon::now()]);
                    $redirect = (Auth::user()->username) ? Auth::user()->username : Auth::user()->id;
                    return redirect('profile/' . $redirect);
                }
            } else {
                session()->regenerate();
                return redirect('login')->with('message', 'Email already exists.')->with('type', 'error');
            }
        } // If user social email does not exists in pakblood db.
        else {
            $socialIdFound = User::where('fb_id', $user->id)->first();
            //If Socialite id found in pakblood user accounts
            if ($socialIdFound) {
                session()->regenerate();
                return redirect('login')->with('message',
                                               'This Account is already attached to a Pakblood account.')->with('type',
                                                                                                                'error');
            } else {
                return view('index', compact('user', 'fb'));
            }
        }
        session()->regenerate();
        return redirect('login')->with('message', 'Something went wrong please try again.')->with('type', 'error');
    }

    /**
     * Facebook login register
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postFbLogin(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->profile_image = $request->input('profile_image');
        $user->fb_id = $request->input('social_id');
        $user->blood_group = $request->input('blood_group');
        $user->gender = $request->input('gender');
        $user->mobile = $request->input('mobile');
        $user->city_id = $request->input('city');
        $user->status = "active";
        if ($user->save()) {
            if (Auth::loginUsingId($user->id)) {
                User::where('id', \Auth::user()->id)->update(['last_login' => Carbon::now()]);
                $data = array(
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'gender' => $user->gender,
                    'dob' => date('Y-m-d', strtotime($request->input('dob'))),
                    'phone' => $user->phone,
                    'mobile' => $user->mobile,
                    'address' => $user->address,
                    'city' => City::where('id', $user->city_id)->pluck('name'),
                    'blood_group' => $user->blood_group,
                    'status' => $user->status,
                );
                Mail::queue('emails/user_registered', $data, function ($message) use ($user) {
                    $message
                        ->to('info@pakblood.com')
                        ->subject('New User Registered');
                });
                return redirect('profile/' . Auth::user()->id);
            }
        }
        return redirect('login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function gpLoginCallback(Request $request)
    {
        if (!\Session::get('state')) {
            return redirect($this->loginPath());
        }
        $user = \Socialite::with('google')->user();
//        dd($user);
        // Condition when user link his/her social account.
        if (\Session::get('userAccountId') && \Session::get('userAccountId') != 0) {
            $userAccount = User::find(\Session::get('userAccountId'));
            if ($userAccount && $userAccount->gp_id == null) {
                $userAccount->gp_id = $user->id;
                $userAccount->save();
                if (Auth::loginUsingId($userAccount->id)) {
                    User::where('id', \Auth::user()->id)->update(['last_login' => Carbon::now()]);
                    $data = array(
                        'name' => \Auth::user()->name,
                        'email' => \Auth::user()->email,
                        'gp_id' => \Auth::user()->gp_id
                    );
                    Mail::queue('emails/social_account_linked', $data, function ($message) use ($data) {
                        $message
                            ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                            ->subject('Google+ Account Linked');
                    });
                    $redirect = (Auth::user()->username) ? Auth::user()->username : Auth::user()->id;
                    return redirect('profile/' . $redirect)->with('message', 'Google+ Account Successfully Connected')
                                                           ->with('type', 'success');
                }
            }
            \Session::set('userAccountId', 0);
        }
        // If user social email exists in pakblood db.
        $userEmailFound = User::where('email', $user->email)->first();

        if ($userEmailFound) {
            $checkUser = new User();
//        dd($checkUser->isDeleted($user->email));
            if ($checkUser->isDeleted($user->email)) {
                return redirect($this->loginPath())
                    ->with("message", "This is account is deactivated.")
                    ->with('type', 'deactivated');
            }
            //If user Facebook id matches with Socialite result id
            if ($userEmailFound->gp_id == $user->id) {
                if (Auth::loginUsingId($userEmailFound->id)) {
                    User::where('id', \Auth::user()->id)->update(['last_login' => Carbon::now()]);
                    $redirect = (Auth::user()->username) ? Auth::user()->username : Auth::user()->id;
                    return redirect('profile/' . $redirect);
                }
            } else {
                return redirect('login')->with('message',
                                               'Email already exists, If you have forgotten your password you can reset it.')->with('type',
                                                                                                                                    'error');
            }
        } // If user social email does not exists in pakblood db.
        else {
            $socialIdFound = User::where('gp_id', $user->id)->first();
            //If Socialite id found in pakblood user accounts
            if ($socialIdFound) {
                return redirect('login')
                    ->with('message', 'This Account is already attached to a Pakblood account.')
                    ->with('type', 'error');
            } else {
                return view('index', compact('user'));
            }
        }
        return redirect('login')->with('message', 'Something went wrong please try again.')->with('type', 'error');
    }

    /**
     * google+ login register
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postGpLogin(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->profile_image = $request->input('profile_image');
        $user->gp_id = $request->input('social_id');
        $user->blood_group = $request->input('blood_group');
        $user->gender = $request->input('gender');
        $user->mobile = $request->input('mobile');
        $user->city_id = $request->input('city');
        $user->status = "active";
        if ($user->save()) {
            if (Auth::loginUsingId($user->id)) {
                User::where('id', \Auth::user()->id)->update(['last_login' => Carbon::now()]);
                $data = array(
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'gender' => $user->gender,
                    'dob' => date('Y-m-d', strtotime($request->input('dob'))),
                    'phone' => $user->phone,
                    'mobile' => $user->mobile,
                    'address' => $user->address,
                    'city' => City::where('id', $user->city_id)->pluck('name'),
                    'blood_group' => $user->blood_group,
                    'status' => $user->status,
                );
                Mail::queue('emails/user_registered', $data, function ($message) use ($user) {
                    $message
                        ->to('info@pakblood.com')
                        ->subject('New User Registered');
                });
                return redirect('profile/' . Auth::user()->id);
            }
        }
        return redirect('login');
    }

    public function getLogout()
    {
        Auth::logout();

        if (\Session::get('redirect')) {
            $this->redirectAfterLogout = \Session::get('redirect');
            \Session::set('redirect', '/login');
        }

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
