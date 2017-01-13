<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Country;
use App\Org;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', \Auth::user()->id)->where('is_deleted', '=', 0)->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        $organizations = Org::where('status', 'active')->get();
        return view('admin.users.add', compact('countries', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dump($request->file());
//        dump($request->file('profile_image')->getClientOriginalExtension());
//        dump($request->file('profile_image')->getClientOriginalName());
//        dd($request->input());
        $rules = array(
            'name'     => 'required',
            'username' => 'required|unique:pb_users',
            'email'    => 'required|unique:pb_users',
            'password' => 'required|confirmed',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect('/admin/user/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $user = new User;
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->gender = $request->input('gender');
            $user->dob = date('y-m-d', strtotime($request->input('dob')));
            $user->phone = $request->input('phone');
            $user->mobile = $request->input('mobile');
            $user->address = $request->input('address');
            $user->city_id = $request->input('city_id');
            $user->blood_group = $request->input('blood_group');
            $user->org_id = $request->input('org_id');
            $user->status = $request->input('status');
            $user->role = $request->input('role');
            if ($user->save()) {
                if ($request->file('profile_image') && $request->file('profile_image') != null) {
                    $img = uniqid($user->id . '_') . '.' .
                           $request->file('profile_image')->getClientOriginalExtension();
                    $request->file('profile_image')->move(
                        base_path() . '/public/images/users/', $img
                    );
                    $user->profile_image = $img;
                    $user->save();
                }
                return redirect('/admin/user')
                    ->with('message', 'User successfully added')
                    ->with('type', 'success');
            }
            return redirect('/admin/user/create')
                ->with('message', 'There was some problem adding user')
                ->with('type', 'error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', '=', $id)->first();
        $org = Org::where('id', '=', $user->org_id)->first();
        $city = Org::join('pb_cities', 'pb_org.city_id', '=', 'pb_cities.id')
                   ->select(DB::raw('pb_cities.*'))
                   ->where('pb_cities.id', '=', '208')
                   ->first();
        $data = array('user' => $user, 'city' => $city, 'org' => $org, 'type' => 'view');
        return view('admin.users.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        dd();
        $user = User::where('id', '=', $id)->first();
        $org = Org::where('id', '=', $user->org_id)->first();
        /* $city = Org::join('pb_cities', 'pb_org.city_id', '=', 'pb_cities.id')
                    ->select(DB::raw('pb_cities.*'))
                    ->where('pb_cities.id', '=', '208')
                    ->first();*/
        $city = City::find($user->city_id);
        $cities = City::where('country_id', $city->country_id)->get();
        $organizations = Org::where('status', 'active')->get();
//        $data = array('user' => $user, 'city' => $city, 'org' => $org, 'type' => 'edit');
        $user['dob'] = date('d-M-y', strtotime($user['dob']));
        $user['last_bleed'] = date('d-M-y', strtotime($user['last_bleed']));
//        dd($user);
        return view('admin.users.edit', compact('user', 'city', 'org', 'cities', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dump($request->file('profile_image'));
//        dd($request->input());
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        if ($request->input('password') != '') {
            $user->password = bcrypt($request->input('password'));
        }
        $user->gender = $request->input('gender');
        $user->dob = date('y-m-d', strtotime($request->input('dob')));
        $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');
        $user->address = $request->input('address');
        $user->city_id = $request->input('city_id');
        $user->org_id = ($request->input('org_id') == '') ? 0 : $request->input('org_id');
        $user->blood_group = $request->input('blood_group');
        $user->status = $request->input('status');
        if ($user->save()) {
            if ($request->file('profile_image') && $request->file('profile_image') != null) {
                $oldImg = $user->profile_image;
                $img = uniqid($user->id . '_') . '.' .
                       $request->file('profile_image')->getClientOriginalExtension();
                $request->file('profile_image')->move(
                    base_path() . '/public/images/users/', $img
                );
                $user->profile_image = $img;
                if ($user->save()) {
                    \File::delete('images/users/' . $oldImg);
                }
            }
            return Redirect::to('/admin/user/' . $id . '/edit')->with('message',
                                                                      'User data successfully updated!')->with('type',
                                                                                                               'success');
        }
        return Redirect::to('/admin/user/' . $id . '/edit')->with('message',
                                                                  'There was some problems saving user data please try again.')->with('type',
                                                                                                                                      'error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd($id);
        $user = User::where('id', '=', $id)->first();
        $org = Org::where('user_id', '=', $id)->first();
        if ($org == NULL) {
            $user->is_deleted = 1;
            if ($user->save()) {
                return redirect('/admin/user')->with('message', 'User account successfully deleted')->with('type',
                                                                                                           'success');
            }
        }
        return redirect()->back()->with('message',
                                        'User account can\'t be deactivated until user is admin of an organization. ')->with('type',
                                                                                                                             'error');
    }

    public function hardDelete($id)
    {
        $user = User::where('id', '=', $id)->first();
        if ($user->delete()) {
            return redirect('/admin/deleted/user')->with('message', 'User account successfully deleted')->with('type',
                                                                                                               'success');
        }
        return redirect('/admin/deleted/user')->with('message',
                                                     'There was some problem deleting user account.')->with('type',
                                                                                                            'error');
    }

    public function undoDelete($id)
    {
        $user = User::where('id', '=', $id)->first();
        $pass = str_random(16);
        $user->is_deleted = 0;
        $user->password = bcrypt($pass);
        if ($user->save()) {
            /*$data = array(
                'name'     => $user->name,
                'email'    => $user->email,
                'password' => $pass,
            );
            Mail::queue('emails/rejoin', $data, function ($message) use ($user) {
                $message
                    ->to($user->email, $user->name)->cc('info@pakblood.com')
                    ->subject('Account Activated');
            });*/
            return redirect('/admin/deleted/user')->with('message', 'User account undone deleted. ')->with('type',
                                                                                                           'success');
        }
        return redirect('/admin/deleted/user')->with('message',
                                                     'Their was some problems undo deleting user')->with('type',
                                                                                                         'success');
    }

    public function getDeleted()
    {
        $data = array(
            'users' => User::select('*')->where('is_deleted', '=', 1)->paginate(15),
            'type'  => 'deleted'
        );
        return view('admin.users.index', $data);
    }

    public function changeStatus($id)
    {
        $user = User::find($id);
        if ($user->status == 'active') {
            $user->status = 'inactive';
            $user->save();
            return redirect('/admin/user')->with('message', 'User status changed to inactive!')->with('type', 'success');
        } else {
            $user->status = 'active';
            $user->save();
            return redirect('/admin/user')->with('message', 'User status changed to active!')->with('type', 'success');
        }
    }

    public function filter(Request $request)
    {
//        dd($request->input());
        $filter = $request->input('filter');
        if ($request->input('status') == 'all' && $request->input('filter') == NULL) {
            $data = [
                'users'  => User::where('id', '!=', \Auth::user()->id)->where('is_deleted', '=',
                                                                              $request->input('is_deleted'))->paginate(15),
                'filter' => $request->input('filter'),
                'status' => $request->input('status'),
                'type'   => $request->input('type'),
            ];
//                    dd($data);
            return view('admin.users.index', $data);
        } elseif ($request->input('filter') != NULL) {
            if ($request->input('status') == 'all') {
                $data = [
                    'users'  => User::where('id', '!=', \Auth::user()->id)
                                    ->where('is_deleted', '=', $request->input('is_deleted'))
                                    ->whereRaw('(name LIKE "%' . $filter . '%"
                            OR email LIKE "%' . $filter . '%"
                            OR address LIKE "%' . $filter . '%"
                            OR phone LIKE "%' . $filter . '%"
                            OR mobile LIKE "%' . $filter . '%")')
                                    ->paginate(15),
                    'filter' => $request->input('filter'),
                    'status' => $request->input('status'),
                    'type'   => $request->input('type'),
                ];
//                dd($data);
                return view('admin.users.index', $data);
            }
            $data = [
                'users'  => User::where('id', '!=', \Auth::user()->id)
                                ->where('status', $request->input('status'))
                                ->where('is_deleted', '=', $request->input('is_deleted'))
                                ->whereRaw('(name LIKE "%' . $filter . '%"
                            OR email LIKE "%' . $filter . '%"
                            OR address LIKE "%' . $filter . '%"
                            OR phone LIKE "%' . $filter . '%"
                            OR mobile LIKE "%' . $filter . '%")')->paginate(15),
                'filter' => $request->input('filter'),
                'status' => $request->input('status'),
                'type'   => $request->input('type'),
            ];
            return view('admin.users.index', $data);
        }
        $data = [
            'users'  => User::where('id', '!=', \Auth::user()->id)
                            ->where('status', $request->input('status'))
                            ->where('is_deleted', '=', $request->input('is_deleted'))
                            ->paginate(15),
            'email'  => $request->input('email'),
            'status' => $request->input('status'),
            'type'   => $request->input('type'),
        ];
//        dump($request->input('status'));
//        dump($request->input('is_deleted'));
//        dd($data);
        return view('admin.users.index', $data);
    }

    function getUser($id)
    {
        $user = User::find($id);
        return \Response::json(['status' => 1, 'user' => $user]);
    }
}
