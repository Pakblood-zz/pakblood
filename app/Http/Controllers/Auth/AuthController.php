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

    protected $redirectPath = '/';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:pb_users',
            'email' => 'required|email|max:255|unique:pb_users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User

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
     */

    /**
     * Create a new user and send verification email to activate account
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails())
        {
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
        $user->city_id = $request->input('city_id');
        $user->blood_group = $request->input('bgroup');
        $user->status = 'inactive';
        $user->confirmation_code = $confirmation_code;

        if ($user->save()) {
            $data = array(
                'name' => $user->name,
                'code' => $confirmation_code,
            );
            Mail::queue('emails/email_verify', $data, function($message) use ($user) {
                $message
                    ->from('noreply@pakblood.com', 'Pakblood')
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
    public function activateAccount($code, User $user)
    {
        if($user->ActivateAccount($code)) {
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
        if($user->hasUser($request->input('email'))){
            if($user->accountIsActive($credentials['email'])==0){
                return redirect($this->loginPath())
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->withErrors([
                        "Account Not Activated, you need to activate your account before login.",
                    ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
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

        return redirect('profile/'.Auth::user()->username);
    }
}
