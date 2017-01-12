<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Org;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orgs = Org::select('*')->paginate();
        return view('admin.org.index', compact('orgs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('status', 'active')->where('is_deleted', 0)->where('org_id', 0)
                     ->where('role', 'user')->get();
        return view('admin.org.add', compact('users'));
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
//        dd($request->input());
        $rules = [
            'name'    => 'required|unique:pb_org',
            'address' => 'required',
            'phone'   => 'required',
            'city_id' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect('/admin/add/organization')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $org = new Org;
            $user = User::find($request->input('user_id'));
            if (count($user) == 0) {
                return redirect()->back()->withInput(Input::all())
                                 ->with('message', 'Please Select an admin for organization.')
                                 ->with('type', 'error');
            }
            if ($user->is_deleted == 1 || $user->status == 'inactive') {
                return redirect()->back()->withInput(Input::all())
                                 ->with('message',
                                        'User with Deactivated account can\'t be admin of an organization or user have not yet confirmed their email.')
                                 ->with('type', 'error');
            } elseif ($user->status == 'reported') {
                return redirect()->back()->withInput(Input::all())
                                 ->with('message', 'Reported users can\'t be admin of an organizaiton')
                                 ->with('type', 'error');
            }
            $org->user_id = $user->id;
            $org->username = $user->username;
            $org->name = $request->input('name');
            $org->address = $request->input('address');
            $org->url = $request->input('url');
            $org->phone = $request->input('phone');
            $org->mobile = $user->mobile;
            $org->city_id = $request->input('city_id');
            $org->admin_name = $user->name;
            $org->email = $user->email;
            $org->status = 'active';
            if ($org->save()) {
                if ($request->hasFile('image')) {
                    $logo = uniqid($org->id . '_') . '.' .
                            $request->file('image')->getClientOriginalExtension();
                    $request->file('image')->move(
                        base_path() . '/public/images/logos/', $logo
                    );
                    $org->image = $logo;
                    $org->save();
                }
                /*DB::table('pb_users')
                  ->where('id', $user->id)
                  ->update(['org_id' => $org->id]);*/
                $user->org_id = $org->id;
                $user->save();
                return redirect('/admin/organization')
                    ->with('message', 'Organization successfully created.')
                    ->with('type', 'success');
            }
            return redirect()->back()->withInput(Input::all())
                             ->with('message', 'There was some probems with creating organizaiton.')
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
        $org = Org::where('id', '=', $id)->first();
        $city = Org::join('pb_cities', 'pb_org.city_id', '=', 'pb_cities.id')
                   ->select(DB::raw('pb_cities.*'))
                   ->where('pb_cities.id', '=', '208')
                   ->first();

        $data = ['org' => $org, 'city' => $city, 'type' => 'view'];
        return view('admin.org.view', $data);
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
        $org = Org::where('id', '=', $id)->first();
        $city = City::find($org->city_id);
        $cities = City::where('country_id', $city->country_id)->get();
        $user = User::find($org->user_id);
        $users = User::where('status', 'active')->where('is_deleted', 0)->where('org_id', 0)
                     ->orWhere('org_id', $org->id)->where('role', 'user')->get();
//        dd($user);
        return view('admin.org.edit', compact('org', 'city', 'cities', 'user', 'users'));
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
//        dd($request->input());
        $user = User::find($request->input('user_id'));
        if (count($user) == 0) {
            return redirect()->back()->withInput(Input::all())
                             ->with('message', 'Please select an admin for organization.')
                             ->with('type', 'error');
        }
        if ($user->is_deleted == 1 || $user->status == 'inactive') {
            return redirect()->back()->withInput(Input::all())
                             ->with('message',
                                    'User with Deactivated account can\'t be admin of an organization or user have not yet confirmed their email.')
                             ->with('type', 'error');
        } elseif ($user->status == 'reported') {
            return redirect()->back()->withInput(Input::all())
                             ->with('message', 'Reported users can\'t be admin of an organizaiton')
                             ->with('type', 'error');
        }
        $org = Org::find($id);
        $org->user_id = $user->id;
        $org->username = $user->username;
        $org->name = $request->input('name');
        $org->address = $request->input('address');
        $org->url = $request->input('url');
        $org->phone = $request->input('phone');
        $org->mobile = $user->mobile;
        $org->city_id = $request->input('city_id');
        $org->admin_name = $user->name;
        $org->email = $user->email;
        $org->status = $request->input('status');
        if ($org->save()) {
            if ($request->hasFile('image')) {
                $oldImg = $org->image;
                $logo = uniqid($org->id . '_') . '.' .
                        $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(
                    base_path() . '/public/images/logos/', $logo
                );
                $org->image = $logo;
                if ($org->save()) {
                    \File::delete('images/logos/' . $oldImg);
                }
            }
            /*DB::table('pb_users')
              ->where('id', $user->id)
              ->update(['org_id' => $org->id]);*/
            $user->org_id = $org->id;
            $user->save();
            return redirect('/admin/organization/' . $org->id . '/edit')
                ->with('message', 'Organization successfully edited.')
                ->with('type', 'success');
        }
        return redirect()->back()->withInput(Input::all())
                         ->with('message', 'There was some problems with editing organization.')
                         ->with('type', 'error');
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
        $org = Org::find($id);
        $users = User::where('org_id', '=', $id)->get();
        $org->is_deleted = ($org->is_deleted) ? 0 : 1;
        if ($org->save()) {
            foreach ($users as $user) {
                $user->org_id = 0;
                $user->save();
            }
            return redirect('/admin/organization')
                ->with('message', 'Organization successfully deleted.')
                ->with('type', 'success');
        }
        return redirect('/admin/organization')
            ->with('message', 'there was some problem deleting Organization.')
            ->with('type', 'error');
    }

    public function filter(Request $request)
    {
        if ($request->input('status') == 'all' && $request->input('email') == NULL) {
            $data = [
                'orgs'   => Org::select('*')->paginate(15),
                'email'  => $request->input('email'),
                'status' => $request->input('status'),
            ];
            return view('admin.org.index', $data);
        } elseif ($request->input('email') != NULL) {
            if ($request->input('status') == 'all') {
                $data = [
                    'orgs'   => Org::where('email', '=', $request->input('email'))->paginate(15),
                    'email'  => $request->input('email'),
                    'status' => $request->input('status'),
                ];
                return view('admin.org.index', $data);
            } elseif ($request->input('status') == 'deleted') {
                $data = [
                    'orgs'   => Org::whereEmailAndIs_deleted($request->input('email'),
                                                             1)->paginate(15),
                    'email'  => $request->input('email'),
                    'status' => $request->input('status'),
                ];
                return view('admin.org.index', $data);
            }
            $data = [
                'orgs'   => Org::whereEmailAndStatus($request->input('email'), $request->input('status'))->paginate(15),
                'email'  => $request->input('email'),
                'status' => $request->input('status'),
            ];
            return view('admin.org.index', $data);
        } elseif ($request->input('status') == 'deleted') {
            if ($request->input('email') != NULL) {
                $data = [
                    'orgs'   => Org::whereEmailAndIs_deleted($request->input('email'),
                                                             1)->paginate(15),
                    'email'  => $request->input('email'),
                    'status' => $request->input('status'),
                ];
                return view('admin.org.index', $data);
            }
            $data = [
                'orgs'   => Org::where('is_deleted', 1)->paginate(15),
                'email'  => $request->input('email'),
                'status' => $request->input('status'),
            ];
            return view('admin.org.index', $data);
        }
        $data = [
            'orgs'   => Org::where('status', '=', $request->input('status'))->paginate(15),
            'email'  => $request->input('email'),
            'status' => $request->input('status'),
        ];
        return view('admin.org.index', $data);
    }

    public function changeStatus($id)
    {
        $org = Org::Where('id', '=', $id)->first();
        if ($org->status == 'active') {
            $org->status = 'inactive';
            $org->save();
        } else {
            $org->status = 'active';
            $org->save();
            $data = [
                'name'     => $org->admin_name,
                'org_name' => $org->name,
                'status'   => 'Accepted',
            ];
            Mail::queue('emails/org_create_request', $data, function ($message) use ($org) {
                $message
                    ->to($org->email, $org->admin_name)
                    ->subject('Organization Create Request');
            });
        }
        return redirect('/admin/organization')->with('message',
                                                     'Organization status successfully changed.')->with('type',
                                                                                                        'success');
    }
}
