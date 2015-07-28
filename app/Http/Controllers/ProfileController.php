<?php

namespace App\Http\Controllers;

use App\Bleed;
use App\Org;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getProfile(){
        $data = array('bleed' => Bleed::select('*')->where('user_id','=',Auth::user()->id)->get());
        return view('profile',$data);
    }
    public function updateProfile(Request $request){
        $user = User::where('id', '=', Auth::user()->id)->first();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->dob = $request->input('dob');
        $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');
        $user->address = $request->input('address');
        $user->city_id = $request->input('city_id');
        $user->blood_group = $request->input('bgroup');
        if($user->save()){
            return Redirect::to('profile/'.$request->input('username'))->with('message', 'Profile Successfully Updated!!')->with('type','success');
        }
        return Redirect::to('profile/'.$request->input('username'))->with('message', 'There was some Problems Saving Your profile please try again.')->with('type','error');
    }
    public function deleteUser(Request $request){
        $org = Org::where('user_id','=',Auth::user()->id)->first();
        if($org != NULL){
            return Redirect::to('profile/'.Auth::user()->username)->with('message', 'Error!! can\'t delete your account until you\'r admin of an Organization,Please change admin of your organization to someone else and try again.')->with('type','error');
        }
        $user = User::where('id','=',Auth::user()->id)->update(['status' => 'inactive']);
        Auth::logout();
        return Redirect::to('/');
    }
    public function changePassword(Request $request){
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('profile/'.Auth::user()->username.'#fndtn-changepassword')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            if(User::where('id','=',Auth::user()->id)->update(['password' => bcrypt($request->input('new_password'))])){
                Auth::logout();
                return Redirect::to('/login')
                    ->with('message','Password Successfully Change.Please login again with your new password.')->with('type','success');
            }
        }
    }
}
