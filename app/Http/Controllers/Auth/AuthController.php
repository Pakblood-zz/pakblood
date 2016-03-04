<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
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

    protected $redirectPath = '/';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'username' => 'required|max:255|unique:pb_users',
            'email'    => 'required|email|max:255|unique:pb_users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */

    protected function create(array $data) {
        return User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'gender'   => $data['gender'],
            'dob'      => $data['dob'],
            'phone'    => $data['phone'],
            'address'  => $data['address'],
            'city_id'  => $data['city_id'],
            'status'   => 'inactive'
        ]);

    }

    /**
     * Create a new user and send verification email to activate account
     */
    public function postRegister(Request $request) {
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
        $user->dob = $request->input('dob');
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
                'code' => $confirmation_code,
            );
            Mail::queue('emails/email_verify', $data, function ($message) use ($user) {
                $message
                    ->to(Input::get('email'), Input::get('username'))/*->cc('info@pakblood.com')*/
                    ->subject('Verification Email');
            });
            return redirect('account/verify');
        }
        else {
            Session::flash('message', 'Your account couldn\'t be created please try again');
            return redirect()->back()->withInput();
        }

    }

    /**
     * Activate user account after reciving confirmation code
     */
    public function activateAccount($code, User $user) {
        if ($user->ActivateAccount($code)) {
            return redirect('account/verified');
        }
        Session::flash('message', 'Your account couldn\'t be activated, please try again');
        return redirect('/');
    }

    /**
     * check if user is active and registered
     */
    public function postLogin(Request $request) {
//        $credentials = $this->getCredentials($request);
//        $user = User::where('email', $request->input('email'))->first();
//        dump($user);
//        dump($request->input('email'));
//        dump($request->input('password'));
//        dump(\Hash::check($request->input('password'), $user->password));
//        dump(Auth::attempt($credentials, $request->has('remember')));
//        dd();
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
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
            if ($user->accountIsActive($credentials['email']) == 0) {
                return redirect($this->loginPath())
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->withErrors([
                        "Account Not Activated, you need to activate your account before login.",
                    ]);
            }
            elseif ($user->isDeleted($request->input('email'))) {
                return redirect($this->loginPath())
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->with("message", "Account deactivation message")
                    ->with('type', 'deactivated');
            }
        }
        if (Auth::attempt($credentials, $request->has('remember'))) {
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
    protected function handleUserWasAuthenticated(Request $request, $throttles) {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }
        $redirectId = (Auth::user()->username != '') ? Auth::user()->username : Auth::user()->id;
        return redirect('profile/' . $redirectId);
    }

    /**
     * Callback function for facebook login
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fbLoginCallback() {
        $user = \Socialite::with('facebook')->user();
        $fb = true;
        // Condition when user is linking his/her social account to pakblood account.
        if (\Session::get('userAccountId') && \Session::get('userAccountId') != 0) {
            $userAccount = User::find(\Session::get('userAccountId'));
            if ($userAccount && $userAccount->fb_id == null) {
                $userAccount->fb_id = $user->id;
                $userAccount->save();
                if (Auth::loginUsingId($userAccount->id)) {
                    $redirect = (Auth::user()->username) ? Auth::user()->username : Auth::user()->id;
                    return redirect('profile/' . $redirect);
                }
            }
            \Session::set('userAccountId', 0);
        }
        // If user social email exists in pakblood db.
        $userEmailFound = User::where('email', $user->email)->first();
        if ($userEmailFound) {
            //If user Facebook id matches with Socialite result id
            if ($userEmailFound->fb_id == $user->id) {
                if (Auth::loginUsingId($userEmailFound->id)) {
                    $redirect = (Auth::user()->username) ? Auth::user()->username : Auth::user()->id;
                    return redirect('profile/' . $redirect);
                }
            }
            else {
                return redirect('login')->with('message', 'Email already exists, If you have forgotten you password you can reset it.')->with('type', 'error');
            }
        }
        // If user social email does not exists in pakblood db.
        else {
            $socialIdFound = User::where('fb_id', $user->id)->first();
            //If Socialite id found in pakblood user accounts
            if ($socialIdFound) {
                return redirect('login')->with('message', 'This Account is already attached to a Pakblood account.')->with('type', 'error');
            }
            else {
                return view('index', compact('user', 'fb'));
            }
        }
        return redirect('login')->with('message', 'Something went wrong please try again.')->with('type', 'error');
    }

    /**
     * Facebook login register
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postFbLogin(Request $request) {
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
                return redirect('profile/' . Auth::user()->id);
            }
        }
        return redirect('login');
    }

    /**
     * Callback function for google+ login
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gpLoginCallback() {
        $user = \Socialite::with('google')->user();
//        dd($user);
        // Condition when user link his/her social account.
        if (\Session::get('userAccountId') && \Session::get('userAccountId') != 0) {
            $userAccount = User::find(\Session::get('userAccountId'));
            if ($userAccount && $userAccount->gp_id == null) {
                $userAccount->gp_id = $user->id;
                $userAccount->save();
                if (Auth::loginUsingId($userAccount->id)) {
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
            //If user Facebook id matches with Socialite result id
            if ($userEmailFound->gp_id == $user->id) {
                if (Auth::loginUsingId($userEmailFound->id)) {
                    $redirect = (Auth::user()->username) ? Auth::user()->username : Auth::user()->id;
                    return redirect('profile/' . $redirect);
                }
            }
            else {
                return redirect('login')->with('message', 'Email already exists, If you have forgotten you password you can reset it.')->with('type', 'error');
            }
        }
        // If user social email does not exists in pakblood db.
        else {
            $socialIdFound = User::where('gp_id', $user->id)->first();
            //If Socialite id found in pakblood user accounts
            if ($socialIdFound) {
                return redirect('login')->with('message', 'This Account is already attached to a Pakblood account.')->with('type', 'error');
            }
            else {
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
    public function postGpLogin(Request $request) {
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
                return redirect('profile/' . Auth::user()->id);
            }
        }
        return redirect('login');
    }

    public function getLogout() {
        Auth::logout();

        if (\Session::get('redirect')) {
            $this->redirectAfterLogout = \Session::get('redirect');
            \Session::set('redirect', '/login');
        }

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
