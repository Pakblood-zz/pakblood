<?php

namespace App\Http\Controllers;

use App\Bleed;
use App\City;
use App\OrgRequests;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Org;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = array('orgs' => Org::where('status', '=', 'active')->paginate(10));
        return view('organizations', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('add_org');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name' => 'required|unique:pb_org',
            'org_address' => 'required',
            'org_phone' => 'required',
            'admin_name' => 'required|unique:pb_org',
            'org_logo' => 'required:mimes:png,jpg,jpeg',
            'org_application' => 'required:mimes:png,jpg,jpeg'
        );
        $validator = Validator::make(Input::all(), $rules);
        $redirect = (Auth::user()->username != '') ? Auth::user()->username : Auth::user()->id;

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/create/organization')
                           ->withErrors($validator)
                           ->withInput(Input::all());
        } else {
            // store
            $org = new Org;
            $org->user_id = Auth::user()->id;
            $org->username = Input::get('admin_username');
            $org->name = Input::get('name');
            $org->address = Input::get('org_address');
            $org->phone = Input::get('org_phone');
            $org->mobile = Input::get('admin_phone');
            $org->city_id = Input::get('city');
            if ($request->hasFile('org_logo')) {
                $logo = $org->name . '_logo' . '.' .
                        $request->file('org_logo')->getClientOriginalExtension();
                $request->file('org_logo')->move(
                    base_path() . '/public/images/logos/', $logo
                );
                $org->image = $logo;
            }
            if ($request->hasFile('org_application')) {
                $application = $org->name . '_application' . '.' .
                               $request->file('org_application')->getClientOriginalExtension();
                $request->file('org_application')->move(
                    base_path() . '/public/images/applications/', $application
                );
                $org->application_image = $application;
            }
            $org->admin_name = Input::get('admin_name');
            $org->program = Input::get('admin_program');
            $org->email = Input::get('admin_email');
            $org->url = Input::get('org_url');

            if ($org->save()) {
                DB::table('pb_users')
                  ->where('id', Auth::user()->id)
                  ->update(['org_id' => $org->id]);
                $data = array(
                    'username' => Auth::user()->username,
                    'email' => Auth::user()->email,
                    'org_name' => Input::get('name')
                );
                Mail::queue('emails/org_register_request', $data, function ($message) use ($org) {
                    $message
                        ->to(Auth::user()->email, Auth::user()->name)->cc('info@pakblood.com')
                        ->subject('Organization Registration');
                });
                return Redirect::to('profile/' . $redirect)->with('message',
                                                                  'Organization registration successful, Your organization will be active after Pakblood admin review!!');
            }
        }
        return Redirect::to('profile/' . $redirect)->with('message',
                                                          'Organization registration error, please try again!!')->with('type',
                                                                                                                       'error');
    }

    /**
     * Send Organization profile data, its members and requests to join that organization.
     *
     * @param  int $id
     * @return Response
     */
    public function getProfile($id)
    {
        if (Auth::guest()) {
            $data = array('org' => Org::whereIdAndStatus($id, 'active')->first());
            return view::make('org_profile', $data);
        }
        $org = Org::whereIdAndStatus($id, 'active')->first();
        $countryId = City::where('id', $org->city_id)->pluck('country_id');
        $data = array(
            'org' => $org,
            'users' => User::where('org_id', '=', $id)->where('id', '!=', Auth::user()->id)->paginate(10),
            'reqs' => OrgRequests::join('pb_users', 'pb_org_join_requests.user_id', '=', 'pb_users.id')
                                 ->join('pb_org', 'pb_org_join_requests.org_id', '=', 'pb_org.id')
                                 ->select(DB::raw('pb_users.*,pb_org_join_requests.id as req_id,pb_org_join_requests.reason'))
                                 ->where('pb_org.id', '=', $id)
                                 ->get(),
            'orgCountry' => $countryId,
            'orgCity' => $org->city_id,
            'orgCities' => City::where('country_id', $countryId)->get(),
        );
        $redirect = (Auth::user()->username != '') ? Auth::user()->username : Auth::user()->id;
        if ($data['org'] == NULL) {
            return redirect('/profile/' . $redirect)
                ->with('message',
                       'Your organization is not active yet, please wait, until pakblood admin review your organization')
                ->with('type', 'error');
        }
        return view::make('org_profile', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $org = Org::where('id', '=', $request->input('org_id'))->first();
        $org->username = $request->Input('admin_username');
        $org->name = $request->Input('org_name');
        $org->address = $request->Input('org_address');
        $org->phone = $request->Input('org_phone');
        $org->mobile = $request->Input('admin_phone');
        $org->city_id = $request->Input('city');
        if ($request->hasFile('org_logo')) {
            $logo = $org->name . '.' .
                    $request->file('org_logo')->getClientOriginalExtension();
            $request->file('org_logo')->move(
                base_path() . '/public/images/logos/', $logo
            );
            $org->image = $logo;
        }
        if ($request->hasFile('org_logo')) {
            $application = $org->name . '.' .
                           $request->file('org_application')->getClientOriginalExtension();
            $request->file('org_application')->move(
                base_path() . '/public/images/applications/', $application
            );
            $org->application_image = $application;
        }
        $org->admin_name = $request->Input('admin_name');
        $org->program = $request->Input('admin_program');
        $org->email = $request->Input('admin_email');
        $org->url = Input::get('org_url');
        $org->save();
        if ($org->save()) {
            return Redirect::to('organization/' . $request->input('org_id') . '#fndtn-editprofile')
                           ->with('message', 'Organization Profile Successfully Updated!!')->with('type', 'success');
        }
        return Redirect::to('organization/' . $request->input('org_id') . '#fndtn-editprofile')
                       ->with('message',
                              'There was some Problems Saving Organization Profile please try again. ')->with('type',
                                                                                                              'error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Register user without email verification when added by an organization
     */
    public function addMember(Request $request)
    {

        $rules = array(
            'name' => 'required',
            'username' => 'required|unique:pb_users',
            'email' => 'required|unique:pb_users|email',
            'password' => 'required|confirmed',
        );
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->fails()) {
            return Redirect('organization/' . $request->input('org_id') . '#fndtn-addmember')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
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
            $user->status = 'active';
            $user->org_id = $request->input('org_id');
            if ($user->save()) {
                return redirect('organization/' . $request->input('org_id') . '#fndtn-addmember')->with('message',
                                                                                                        'Member registered successfully')->with('type',
                                                                                                                                                'success');
            }
            return redirect('organization/' . $request->input('org_id') . '#fndtn-addmember')->with('message',
                                                                                                    'There was some problem registering member')->with('type',
                                                                                                                                                       'error');
        }
    }

    /**
     * Change Organization Admin
     */
    public function changeAdmin(Request $request)
    {
        $user = User::where('id', '=', $request->input('new_owner'))->first();
        $oldAdmin = User::where('id', \Auth::user()->id)->first();
        $org = Org::where('id', '=', $request->input('org_id'))->first();
        $org->user_id = $user->id;
        $org->username = $user->username;
        $org->mobile = $user->mobile;
        $org->admin_name = $user->name;
        $org->program = '';
        $org->email = $user->email;
        if ($org->save()) {
            $data = [
                'name' => $oldAdmin->name,
                'oldEmail' => $oldAdmin->email,
                'newEmail' => $user->email,
                'org' => $org->name,
                'toUser' => $user->name,
            ];
            Mail::queue('emails/rejoin', $data, function ($message) use ($data) {
                $message
                    ->to($data['oldEmail'])->cc($data['newEmail'])->cc('info@pakblood.com')
                    ->subject('Account Activated');
            });
            return redirect('profile/' . Auth::user()->username)->with('message',
                                                                       'Ownership of organization successfully changed.')->with('type',
                                                                                                                                'success');
        }
        return redirect('organization/' . $request->input('org_id') . '#fndtn-adminsettings')->with('message',
                                                                                                    'There was some problems transferring ownership, please try again')->with('type',
                                                                                                                                                                              'error');
    }

    /**
     * Delete Member
     */
    public function deleteMember($id)
    {
        $user = User::where('id', '=', $id)->delete();
        return redirect('/organization/' . Auth::user()->org_id . '#fndtn-viewmember')->with('message',
                                                                                             'Member successfully deleted')->with('type',
                                                                                                                                  'success');
    }

    /**
     * Accept request to join organization
     */
    public function acceptRequest($id)
    {
        $req = OrgRequests::where('id', '=', $id)->first();
        $user = User::where('id', '=', $req->user_id)->first();
        $org = Org::where('id', '=', $req->org_id)->first();
        $user->org_id = $req->org_id;
        if ($user->save()) {
            $data = array(
                'name' => $user->name,
                'email' => $user->email,
                'org_name' => $org->name,
                'status' => 'Accepted'
            );
            Mail::queue('emails/org_join_request', $data, function ($message) use ($user) {
                $message
                    ->from('noreply@pakblood.com', 'Pakblood')
                    ->to($user->email, $user->name)
                    ->subject('Request To Join Organization');
            });
            $req->delete();
            return redirect('organization/' . $user->org_id . '#fndtn-viewrequests')->with('message',
                                                                                           'Member join request accepted')->with('type',
                                                                                                                                 'success');
        }
        return redirect('organization/' . $req->org_id . '#fndtn-viewrequests')->with('message',
                                                                                      'There was some problems accepting request,please try again')->with('type',
                                                                                                                                                          'error');
    }

    /**
     * Reject request to join organization
     */
    public function rejectRequest($id)
    {
        $req = OrgRequests::where('id', '=', $id)->first();
        $user = User::where('id', '=', $req->user_id)->first();
        $org = Org::where('id', '=', $req->org_id)->first();
        if ($req->delete()) {
            $data = array(
                'name' => $user->name,
                'email' => $user->email,
                'org_name' => $org->name,
                'status' => 'Rejected'
            );
            Mail::queue('emails/org_join_request', $data, function ($message) use ($user) {
                $message
                    ->from('noreply@pakblood.com', 'Pakblood')
                    ->to($user->email, $user->name)
                    ->subject('Request To Join Organization');
            });
            $req->delete();
            return redirect('organization/' . $req->org_id . '#fndtn-viewrequests')->with('message',
                                                                                          'Member join request rejected')->with('type',
                                                                                                                                'success');
        }
        return redirect('organization/' . $req->org_id . '#fndtn-viewrequests')->with('message',
                                                                                      'There was some problems rejecting request,please try again')->with('type',
                                                                                                                                                          'error');
    }

    public function delete(Request $request)
    {
        $org = Org::where('id', '=', $request->input('org_id'));
        $users = User::where('org_id', '=', $request->input('org_id'))->get();
        foreach ($users as $user) {
            $user->org_id = 0;
            $user->save();
        }
        if ($org->delete()) {
            return redirect('/profile/' . Auth::user()->id)
                ->with('message', 'Organization successfully deleted.')
                ->with('type', 'success');
        }
        return redirect()->back()
                         ->with('message', 'there was some problem deleting Organization.')
                         ->with('type', 'error');
    }
}
