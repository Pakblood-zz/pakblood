<?php

namespace App\Http\Controllers\Admin;

use App\AdminModels\Admin;
use App\Org;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){
        $data = array('total_org' => Org::where('status','=','active')->count(),
            'total_user' => User::where('status','=','active')->count());
        return view('admin.dashboard',$data);
    }

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);

        $credentials = array('login' => $request->input('username'), 'password' => $request->input('password'));
        if (Auth::attempt($credentials)) {
            return redirect('/admin');
        }
        return redirect('/admin')->with('message' , 'Wrong Username or Password')->with('type' ,'error');
    }
}
