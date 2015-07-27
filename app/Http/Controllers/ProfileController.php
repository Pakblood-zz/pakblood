<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function getProfile(){
        return view('profile');
    }
    public function updateProfile(Request $request){
        $user = User::where('id', '=', Auth::user()->id)->first();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->dob = $request->input('dob');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->city_id = $request->input('city_id');
        $user->blood_group = $request->input('bgroup');
        if($user->save()){
            return Redirect::to('profile/'.$request->input('username'))->with('message', 'Profile Successfully Updated!!');
        }
        return Redirect::to('profile/'.$request->input('username'))->with('message', 'There was some Problems Saving Your profile please try again. ');
    }
}
