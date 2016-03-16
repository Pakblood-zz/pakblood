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

class MainController extends Controller {

    public function index() {
        $data = [
            'activeOrg'    => Org::where('status', '=', 'active')->count(),
            'inactiveOrg'  => Org::where('status', '=', 'inactive')->count(),
            'activeUser'   => User::where('status', '=', 'active')->count(),
            'inactiveUser' => User::where('status', '=', 'inactive')->count(),
            'reportedUser' => User::where('status', '=', 'reported')->count(),
        ];
        return view('admin.dashboard', $data);
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);

        $credentials = array('login' => $request->input('username'), 'password' => $request->input('password'));
        if (Auth::attempt($credentials)) {
            return redirect('/admin');
        }
        return redirect('/admin')->with('message', 'Wrong Username or Password')->with('type', 'error');
    }

    public function getData() {
        $term = \Input::get('term');
        $table = \Input::get('table');

        $results = array();

        $queries = \DB::table('pb_' . $table)
            ->where('email', 'LIKE', '%' . $term . '%')
            ->take(10)
            ->get();

        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->email];
        }
        return \Response::json($results);
    }
}
