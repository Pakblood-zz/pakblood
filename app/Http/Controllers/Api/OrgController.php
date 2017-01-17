<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Org;
use App\OrgRequests;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrgController extends Controller
{
    /**
     * Get list of all organizations
     * @return mixed
     */
    public function index()
    {
        $data = Org::where('status', '=', 'active')->get();
        return \Response::json([
                                   'data'         => $data,
                                   'responseCode' => 1
                               ], 200);
    }

    /**
     * Send join request for an organization
     *
     * @param Request $request
     * @param         $orgId
     *
     * @return mixed
     */
    public function orgJoinRequest(Request $request, $orgId)
    {
        $input = \Input::json();
//        $orgId = $input->get('org_id');
        $reason = $input->get('reason');
        if (\Auth::guest()) {
            return \Response::json([
                                       'responseMessage' => 'Error! User not logedin.',
                                       'responseCode'    => -5
                                   ], 400);
        }
        if ((OrgRequests::whereUser_idAndOrg_id(\Auth::user()->id, $orgId)->count()) > 0) {
            return \Response::json([
                                       'responseMessage' => 'You have already sent a request to join this organization, please wait until organization admin approve your request.',
                                       'responseCode'    => -2
                                   ],
                                   400);
        }

        $org = Org::find($orgId);
        if (count($org) == 0) {
            return \Response::json([
                                       'responseMessage' => 'Error! Organization not found.',
                                       'responseCode'    => -4
                                   ], 400);
        }
        $orgreq = new OrgRequests;
        $orgreq->user_id = \Auth::user()->id;
        $orgreq->org_id = $org->id;
        $orgreq->reason = $reason;
        if ($orgreq->save()) {
            $data = [
                'name'        => $org->admin_name,
                'email'       => $org->email,
                'org'         => $org->name,
                'member'      => \Auth::user()->name,
                'memberEmail' => \Auth::user()->email,
            ];
            \Mail::send(['html' => 'emails/org_member_request'], $data, function ($message) use ($data) {
                $message
                    ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                    ->replyTo($data['memberEmail'], $data['member'])
                    ->subject('User Join Request.');
            });
            return \Response::json([
                                       'responseMessage' => 'Request successfully submitted, please wait for organization admin to approve your request.',
                                       'responseCode'    => 1
                                   ],
                                   200);
        }
        return \Response::json([
                                   'responseMessage' => 'Error! could not send request to organization please try again.',
                                   'responseCode'    => -1
                               ], 400);
    }

    /**
     * Add organization
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $input = \Input::json();
//        dd($input);
        $org = new Org;
        $org->user_id = \Auth::user()->id;
        $org->username = $input->get('admin_username');
        $org->admin_name = $input->get('admin_name');
        $org->program = $input->get('admin_program');
        $org->email = $input->get('admin_email');
        $org->name = $input->get('name');
        $org->address = $input->get('org_address');
        $org->phone = $input->get('org_phone');
        $org->mobile = $input->get('admin_phone');
        $org->city_id = $input->get('city');
        $org->url = $input->get('org_url');
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

        if ($org->save()) {
            \DB::table('pb_users')
               ->where('id', \Auth::user()->id)
               ->update(['org_id' => $org->id]);
            $data = array(
                'username' => \Auth::user()->username,
                'email'    => \Auth::user()->email,
                'org_name' => \Input::get('name')
            );
            \Mail::queue('emails/org_register_request', $data, function ($message) use ($org) {
                $message
                    ->to(\Auth::user()->email, \Auth::user()->name)->cc('info@pakblood.com')
                    ->subject('Organization Registration');
            });
            return \Response::json([
                                       'responseMessage' => 'Organization registration successful, Your organization will be active after Pakblood admin review.',
                                       'responseCode'    => 1
                                   ],
                                   200);
        }
        return \Response::json([
                                   'responseMessage' => 'Organization registration error, please try again.',
                                   'responseCode'    => 1
                               ], 400);
    }

    /**
     * Update organization data
     *
     * @param Request $request
     * @param         $orgId
     *
     * @return mixed
     */
    public function update(Request $request, $orgId)
    {
        $input = \Input::json();
        $org = Org::where('id', '=', $orgId)->first();
        if (\Auth::guest()) {
            return \Response::json(['msg' => 'Error! User not logedin.'], 400);
        }
        if (count($org) == 0) {
            return \Response::json(['msg' => 'Error! Organization not found.'], 400);
        }
        $org->username = $input->get('admin_username');
        $org->name = $input->get('org_name');
        $org->address = $input->get('org_address');
        $org->phone = $input->get('org_phone');
        $org->mobile = $input->get('admin_phone');
        $org->city_id = $input->get('city');
        if ($request->hasFile('org_logo')) {
            $logo = $org->name . '_log' . '.' .
                    $request->file('org_logo')->getClientOriginalExtension();
            $request->file('org_logo')->move(
                base_path() . '/public/images/logos/', $logo
            );
            $org->image = $logo;
        }
        if ($request->hasFile('org_logo')) {
            $application = $org->name . '_application' . '.' .
                           $request->file('org_application')->getClientOriginalExtension();
            $request->file('org_application')->move(
                base_path() . '/public/images/applications/', $application
            );
            $org->application_image = $application;
        }
        $org->admin_name = $input->get('admin_name');
        $org->program = $input->get('admin_program');
        $org->email = $input->get('admin_email');
        $org->url = $input->get('org_url');
        $org->save();
        if ($org->save()) {
            return \Response::json([
                                       'responseMessage' => 'Organization Profile Successfully Updated.',
                                       'responseCode'    => 1
                                   ], 200);
        }
        return \Response::json([
                                   'responseMessage' => 'There was some Problems Saving Organization Profile please try again.',
                                   'responseCode'    => -1
                               ], 400);
    }

    /**
     * Add or Update organizations member details
     *
     * @param Request $request
     * @param         $orgId
     * @param null    $uId
     *
     * @return mixed
     */
    public function addMember(Request $request, $orgId, $uId = null)
    {
        $input = \Input::json();
        if ($uId) {
            $user = User::find($uId);
            $msg = 'member successfully updated.';
        } else {
            $user = new User;
            $msg = 'member successfully added.';
        }
        $user->name = ($input->get('name')) ? $input->get('name') : $user->name;
        $user->username = ($input->get('username')) ? $input->get('username') : $user->username;
        $user->email = ($input->get('email')) ? $input->get('email') : $user->email;
        $user->password = ($input->get('password')) ? bcrypt($input->get('password')) : $user->password;
        $user->gender = ($input->get('gender')) ? $input->get('gender') : $user->gender;
        $user->dob = ($input->get('dob')) ? $input->get('dob') : $user->dob;
        $user->phone = ($input->get('phone')) ? $input->get('phone') : $user->phone;
        $user->mobile = ($input->get('mobile')) ? $input->get('mobile') : $user->mobile;
        $user->address = ($input->get('address')) ? $input->get('address') : $user->address;
        $user->city_id = ($input->get('city')) ? $input->get('city') : $user->city_id;
        $user->blood_group = ($input->get('bgroup')) ? $input->get('bgroup') : $user->blood_group;
        $user->status = 'active';
        $user->org_id = $orgId;
        if ($user->save()) {
            return \Response::json([
                                       'responseMessage' => $msg,
                                       'responseCode'    => 1
                                   ], 200);
        }
        return \Response::json([
                                   'responseMessage' => 'error adding/updating member.',
                                   'responseCode'    => -2
                               ], 400);
    }

    /**
     * Change admin of an organization
     *
     * @param Request $request
     * @param         $orgId
     *
     * @return mixed
     */
    public function changeAdmin(Request $request, $orgId)
    {
        $input = \Input::json();
        $newOwner = $input->get('new_owner');
        $user = User::where('id', '=', $newOwner)->first();
        $oldAdmin = User::where('id', \Auth::user()->id)->first();
        $org = Org::where('id', '=', $orgId)->first();
        $org->user_id = $user->id;
        $org->username = $user->username;
        $org->mobile = $user->mobile;
        $org->admin_name = $user->name;
        $org->program = '';
        $org->email = $user->email;
        if ($org->save()) {
            $data = [
                'name'     => $oldAdmin->name,
                'oldEmail' => $oldAdmin->email,
                'newEmail' => $user->email,
                'org'      => $org->name,
                'toUser'   => $user->name,
            ];
            \Mail::queue('emails/org_ownership_changed', $data, function ($message) use ($data) {
                $message
                    ->to($data['oldEmail'])->cc($data['newEmail'])->cc('info@pakblood.com')
                    ->subject('Account Activated');
            });
            return \Response::json([
                                       'responseMessage' => 'Ownership successfully changed.',
                                       'responseCode'    => 1
                                   ], 200);
        }
        return \Response::json([
                                   'responseMessage' => 'Error! Changing ownership',
                                   'responseCode'    => -2
                               ], 400);
    }

    /**
     * Delete member of an organization
     *
     * @param $orgId
     * @param $uId
     *
     * @return mixed
     */
    public function deleteMember($orgId, $uId)
    {
        $user = User::where('id', '=', $uId)->where('org_id', $orgId)->first();
        if ($user) {
            $user->is_deleted = 1;
            if ($user->save()) {
                return \Response::json([
                                           'responseMessage' => 'Member successfully deleted.',
                                           'responseCode'    => 1
                                       ], 200);
            }
            return \Response::json([
                                       'responseMessage' => 'There was error deleting member.',
                                       'responseCode'    => -2
                                   ], 400);
        } else {
            return \Response::json([
                                       'responseMessage' => 'Member does not exist or not in ur organization.',
                                       'responseCode'    => -4
                                   ], 400);
        }
    }

    /**
     * Get list of join request of an organization
     *
     * @param $orgId
     *
     * @return mixed
     */
    public function getAllRequest($orgId)
    {
        $req = OrgRequests::where('org_id', $orgId)->get();
        return \Response::json([
                                   'req'          => $req,
                                   'responseCode' => 1
                               ], 200);
    }

    /**
     * Update user join request for organization
     *
     * @param         $orgId
     * @param         $requestId
     * @param Request $request
     *
     * @return mixed
     */
    public function updateRequest($orgId, $requestId, Request $request)
    {
        $req = OrgRequests::where('id', $requestId)->where('org_id', $orgId)->first();
        if (count($req) == 0) {
            return \Response::json([
                                       'responseMessage' => 'Invalid request id.',
                                       'responseCode'    => -4
                                   ], 400);
        }
        $user = User::where('id', $req->user_id)->first();
        if (count($user) == 0) {
            return \Response::json([
                                       'responseMessage' => 'Error! User not found.',
                                       'responseCode'    => -4
                                   ], 400);
        }
        $org = Org::where('id', $orgId)->first();
        if (count($org) == 0) {
            return \Response::json([
                                       'responseMessage' => 'Error! Organization not found.',
                                       'responseCode'    => -4
                                   ], 400);
        }
        $user->org_id = $orgId;
        if (!$request->input('status')) {
            $req->delete();
            return \Response::json([
                                       'responseMessage' => 'Request rejected.',
                                       'responseCode'    => 1
                                   ], 200);
        }
        if ($user->save()) {
            $data = array(
                'name'     => $user->name,
                'email'    => $user->email,
                'org_name' => $org->name,
                'status'   => 'Accepted'
            );
            \Mail::queue('emails/org_join_request', $data, function ($message) use ($user) {
                $message
                    ->from('noreply@pakblood.com', 'Pakblood')
                    ->to($user->email, $user->name)
                    ->subject('Request To Join Organization');
            });
            $req->delete();
            return \Response::json([
                                       'responseMessage' => 'Request accepted.',
                                       'responseCode'    => 1
                                   ], 200);
        }
        return \Response::json([
                                   'responseMessage' => 'Error! While updating request.',
                                   'responseCode'    => -2
                               ], 400);
    }

    /**
     * Get organization profile data (Eg users, request, country, city)
     *
     * @param $id
     *
     * @return mixed
     */
    public function getProfile($id)
    {
        if (\Auth::guest()) {
            $org = Org::whereIdAndStatus($id, 'active')->first();
            return \Response::json(['org' => $org], 200);
//            return view::make('org_profile', compact('org'));
        }
        $org = Org::whereIdAndStatus($id, 'active')->first();
        if (!$org) {
            return \Response::json([
                                       'responseMessage' => 'Error! Organization not found or not active.',
                                       'responseCode'    => -4
                                   ]);
        }
        $countryId = City::where('id', $org->city_id)->pluck('country_id');
        $users = User::where('org_id', '=', $id)->where('id', '!=', \Auth::user()->id)->paginate(10);
        $reqs = OrgRequests::join('pb_users', 'pb_org_join_requests.user_id', '=', 'pb_users.id')
                           ->join('pb_org', 'pb_org_join_requests.org_id', '=', 'pb_org.id')
                           ->select(\DB::raw('pb_users.*,pb_org_join_requests.id as req_id,pb_org_join_requests.reason'))
                           ->where('pb_org.id', '=', $id)
                           ->get();
        $orgCity = $org->city_id;
        $orgCities = City::where('country_id', $countryId)->get();

        return \Response::json([
                                   'org'          => $org,
                                   'orgCountry'   => $countryId,
                                   'orgCity'      => $orgCity,
                                   'cities'       => $orgCities,
                                   'users'        => $users,
                                   'reqs'         => $reqs,
                                   'responseCode' => 1
                               ], 200);
    }

    /**
     * Reject request to join organization
     */
//    public function rejectRequest($id)
//    {
//        $req = OrgRequests::where('id', '=', $id)->first();
//        $user = User::where('id', '=', $req->user_id)->first();
//        $org = Org::where('id', '=', $req->org_id)->first();
//        if ($req->delete()) {
//            $data = array(
//                'name'     => $user->name,
//                'email'    => $user->email,
//                'org_name' => $org->name,
//                'status'   => 'Rejected'
//            );
//            Mail::queue('emails/org_join_request', $data, function ($message) use ($user) {
//                $message
//                    ->from('noreply@pakblood.com', 'Pakblood')
//                    ->to($user->email, $user->name)
//                    ->subject('Request To Join Organization');
//            });
//            $req->delete();
//            return redirect('organization/' . $req->org_id . '#fndtn-viewrequests')->with('message',
//                                                                                          'Member join request rejected')->with('type',
//                                                                                                                                'success');
//        }
//        return redirect('organization/' . $req->org_id . '#fndtn-viewrequests')->with('message',
//                                                                                      'There was some problems rejecting request,please try again')->with('type',
//                                                                                                                                                          'error');
//    }

//    public function delete(Request $request)
//    {
//        $org = Org::where('id', '=', $request->input('org_id'));
//        $users = User::where('org_id', '=', $request->input('org_id'))->get();
//        foreach ($users as $user) {
//            $user->org_id = 0;
//            $user->save();
//        }
//        if ($org->delete()) {
//            return redirect('/profile/' . Auth::user()->id)
//                ->with('message', 'Organization successfully deleted.')
//                ->with('type', 'success');
//        }
//        return redirect()->back()
//                         ->with('message', 'there was some problem deleting Organization.')
//                         ->with('type', 'error');
//    }
}
