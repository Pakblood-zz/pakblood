<?php

namespace App\Http\Controllers\ApiEmber;

use App\City;
use App\Org;
use App\OrgRequests;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrgController extends Controller {
    /**
     * Get list of all organizations
     * @return mixed
     */
    public function index(Request $request) {
        $input = $request->input();
        //        dump($input);
        //        dd();
        if (isset($input['include']) && $input['include'] == 'users' && isset($input['org'])) {
            $users = User::where('org_id', $input['org'])->where('id', '!=', \Auth::user()->id)->get();
            $org   = Org::find($input['org']);

            return \Response::json([
                'users' => $users,
                'orgs' => [$org]
            ], 200);
        } else {
            $data = Org::where('status', '=', 'active')->get();

            return \Response::json([
                'orgs' => $data
            ], 200);
        }
    }

    /**
     * Send join request for an organization
     *
     * @param Request $request
     * @param         $orgId
     *
     * @return mixed
     */
    public function orgJoinRequest(Request $request) {
        //        $input = \Input::json();
        $input = $request->input();
        //        dd($input);
        //        $orgId = $input->get('org_id');
        $reason = $input['reason'];
        $orgId  = $input['orgId'];

        if (\Auth::guest()) {
            return \Response::json([
                'responseMessage' => 'Error! User not logedin.',
                'responseCode' => -5
            ], 400);
        }
        if ((OrgRequests::whereUser_idAndOrg_id(\Auth::user()->id, $orgId)->count()) > 0) {
            return \Response::json([
                'responseMessage' => 'You have already sent a request to join this organization, please wait until organization admin approve your request.',
                'responseCode' => -2
            ],
                400);
        }

        $org = Org::find($orgId);

        if (count($org) == 0) {
            return \Response::json([
                'responseMessage' => 'Error! Organization not found.',
                'responseCode' => -4
            ], 400);
        }

        $orgreq = new OrgRequests;

        $orgreq->user_id = \Auth::user()->id;
        $orgreq->org_id  = $org->id;
        $orgreq->reason  = $reason;

        if ($orgreq->save()) {
            $data = [
                'name' => $org->admin_name,
                'email' => $org->email,
                'org' => $org->name,
                'member' => \Auth::user()->name,
                'memberEmail' => \Auth::user()->email,
            ];
            if (\Config::get('settings.environment') == 'production') {
                \Mail::send(['html' => 'emails/org_member_request'], $data, function ($message) use ($data) {
                    $message
                        ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                        ->replyTo($data['memberEmail'], $data['member'])
                        ->subject('User Join Request.');
                });
            }
            return \Response::json([
                'responseMessage' => 'Request successfully submitted, please wait for organization admin to approve your request.',
                'responseCode' => 1
            ],
                200);
        }
        return \Response::json([
            'responseMessage' => 'Error! could not send request to organization please try again.',
            'responseCode' => -1
        ], 400);
    }

    /**
     * Add organization
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request) {
        //        $input = \Input::json();
        $input = $request->input('org');
        //        dd($input);
        $org             = new Org;
        $org->user_id    = \Auth::user()->id;
        $org->username   = \Auth::user()->username;
        $org->admin_name = \Auth::user()->name;
        $org->program    = '';
        $org->email      = \Auth::user()->email;
        $org->name       = $input['name'];
        $org->address    = $input['address'];
        $org->phone      = $input['phone'];
        $org->mobile     = \Auth::user()->mobile;
        $org->city_id    = $input['city_id'];
        $org->url        = $input['url'];

        //        dd($org);

        if ($org->save()) {

            if (isset($input['logo_name']) && isset($input['logo_path'])) {
                $imgName = $org->id . '_' . $input['logo_name'];
                $imgPath = $input['logo_path'];
                unset($input['logo_name']);
                unset($input['logo_path']);
                $oldPath = public_path() . $imgPath;
                $newPath = public_path() . "/images/logos/" . $imgName;
                if (\File::exists($oldPath)) {
                    \File::move($oldPath, $newPath);
                }
                $org->image = $imgName;
            }

            if (isset($input['application_image_name']) && isset($input['application_image_path'])) {
                $imgName = $org->id . '_' . $input['application_image_name'];
                $imgPath = $input['application_image_path'];
                unset($input['application_image_name']);
                unset($input['application_image_path']);
                $oldPath = public_path() . $imgPath;
                $newPath = public_path() . "/images/applications/" . $imgName;
                if (\File::exists($oldPath)) {
                    \File::move($oldPath, $newPath);
                }
                $org->application_image = $imgName;
            }

            \DB::table('pb_users')
                ->where('id', \Auth::user()->id)
                ->update(['org_id' => $org->id]);
            $data = array(
                'username' => \Auth::user()->username,
                'email' => \Auth::user()->email,
                'org_name' => \Input::get('name')
            );
            if (\Config::get('settings.environment') == 'production') {
                \Mail::queue('emails/org_register_request', $data, function ($message) use ($org) {
                    $message
                        ->to(\Auth::user()->email, \Auth::user()->name)->cc('info@pakblood.com')
                        ->subject('Organization Registration');
                });
            }
            return \Response::json([
                //                'responseMessage' => 'Organization registration successful, Your organization will be active after Pakblood admin review.',
                //                'responseCode' => 1
                'org' => $org
            ],
                200);
        }
        return \Response::json([
            'responseMessage' => 'Organization registration error, please try again.',
            'responseCode' => 1
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
    public function update(Request $request, $orgId) {
        $input = \Input::json()->get('org');
        //        dump($orgId);
        //        dump($input);
        $org = Org::find($orgId);
        //                dd();
        if (\Auth::guest()) {
            return \Response::json(['msg' => 'Error! User not logedin.'], 400);
        }
        if (count($org) == 0) {
            return \Response::json(['msg' => 'Error! Organization not found.'], 400);
        }
        $org->username = $input['username'];
        $org->name     = $input['name'];
        $org->address  = $input['address'];
        $org->phone    = $input['phone'];
        $org->mobile   = $input['mobile'];
        $org->city_id  = $input['city_id'];
        if (isset($input['logo_name']) && isset($input['logo_path'])) {
            $imgName = $org->id . '_' . $input['logo_name'];
            $imgPath = $input['logo_path'];
            unset($input['logo_name']);
            unset($input['logo_path']);
            $oldPath = public_path() . $imgPath;
            $newPath = public_path() . "/images/logos/" . $imgName;
            if (\File::exists($oldPath)) {
                \File::move($oldPath, $newPath);
            }
            $org->image = $imgName;
        }
        $org->admin_name = $input['admin_name'];
        $org->program    = $input['program'];
        $org->email      = $input['email'];
        $org->url        = $input['url'];
        //        dd($org);
        $org->save();
        if ($org->save()) {
            return \Response::json([
                'org' => $org
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'There was some Problems Saving Organization Profile please try again.',
            'responseCode' => -1
        ], 400);
    }

    /**
     * Add or Update organizations member details
     *
     * @param Request $request
     * @param         $orgId
     * @param null $uId
     *
     * @return mixed
     */
    public function addMember(Request $request) {
        //        $input = \Input::json();
        $input = $request->input();
        //        dump($input);
        //        dd();
        $user = new User;

        $user->name        = $input['name'];
        $user->username    = $input['username'];
        $user->email       = $input['email'];
        $user->password    = $input['password'];
        $user->gender      = $input['gender'];
        $user->dob         = $input['dob'];
        $user->phone       = $input['phone'];
        $user->mobile      = $input['mobile'];
        $user->address     = $input['address'];
        $user->city_id     = $input['city_id'];
        $user->blood_group = $input['blood_group'];
        $user->status      = 'active';
        $user->org_id      = $input['org_id'];

        if ($user->save()) {

            if (isset($input['image_name']) && isset($input['image_path'])) {
                $imgName = $user->id . '_' . $input['image_name'];
                $imgPath = $input['image_path'];
                unset($input['image_name']);
                unset($input['image_path']);
                $oldPath = public_path() . $imgPath;
                $newPath = public_path() . "/images/users/" . $imgName;
                if (\File::exists($oldPath)) {
                    \File::move($oldPath, $newPath);
                }
                $user->profile_image = $imgName;
                $user->save();
            }

            return \Response::json([
                'responseMessage' => 'success',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'error adding/updating member.',
            'responseCode' => -2
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
    public function changeAdmin(Request $request, $orgId) {
        //        $input = \Input::json();
        $input = $request->input();
        //        dump($input);
        //        dd();
        $newOwner = $input['new_owner'];

        $user = User::find($newOwner);

        $oldAdmin = User::find(\Auth::user()->id);

        $org             = Org::find($orgId);
        $org->user_id    = $user->id;
        $org->username   = $user->username;
        $org->mobile     = $user->mobile;
        $org->admin_name = $user->name;
        $org->program    = '';
        $org->email      = $user->email;

        if ($org->save()) {
            $data = [
                'name' => $oldAdmin->name,
                'oldEmail' => $oldAdmin->email,
                'newEmail' => $user->email,
                'org' => $org->name,
                'toUser' => $user->name,
            ];

            if (\Config::get('settings.environment') == 'production') {
                \Mail::queue('emails/org_ownership_changed', $data, function ($message) use ($data) {
                    $message
                        ->to($data['oldEmail'])->cc($data['newEmail'])->cc('info@pakblood.com')
                        ->subject('Organization Ownership Changed');
                });
            }

            return \Response::json([
                'responseMessage' => 'Ownership successfully changed.',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'Error! Changing ownership',
            'responseCode' => -2
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
    public function deleteMember($orgId, $uId) {
        $user = User::where('id', '=', $uId)->where('org_id', $orgId)->first();
        if ($user) {
            $user->is_deleted = 1;
            if ($user->save()) {
                return \Response::json([
                    'responseMessage' => 'Member successfully deleted.',
                    'responseCode' => 1
                ], 200);
            }
            return \Response::json([
                'responseMessage' => 'There was error deleting member.',
                'responseCode' => -2
            ], 400);
        } else {
            return \Response::json([
                'responseMessage' => 'Member does not exist or not in ur organization.',
                'responseCode' => -4
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
    public function getAllRequest($orgId) {
        //        $req = OrgRequests::where('org_id', $orgId)->get();
        $req = OrgRequests::join('pb_users', 'pb_org_join_requests.user_id', '=', 'pb_users.id')
            ->join('pb_org', 'pb_org_join_requests.org_id', '=', 'pb_org.id')
            ->select(\DB::raw('pb_users.*,pb_org_join_requests.id as req_id,pb_org_join_requests.reason'))
            ->where('pb_org.id', '=', $orgId)
            ->get();

        return \Response::json([
            'req' => $req,
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
    public function updateRequest($orgId, $requestId, Request $request) {
        $input  = $request->input();
        $status = $input['status'];
        //        dump($status);
        //        dump($requestId);
        //        dump($orgId);
        //        dd();
        $req = OrgRequests::find($requestId);

        if (count($req) == 0) {
            return \Response::json([
                'responseMessage' => 'Invalid request id.',
                'responseCode' => -4
            ], 400);
        }

        $user = User::find($req->user_id);

        if (count($user) == 0) {
            return \Response::json([
                'responseMessage' => 'Error! User not found.',
                'responseCode' => -4
            ], 400);
        }

        $org = Org::find($orgId);

        if (count($org) == 0) {
            return \Response::json([
                'responseMessage' => 'Error! Organization not found.',
                'responseCode' => -4
            ], 400);
        }

        if (!$status) {
            $req->delete();
            return \Response::json([
                'responseMessage' => 'Request rejected.',
                'responseCode' => 1
            ], 200);
        }

        $user->org_id = $orgId;

        if ($user->save()) {
            $data = array(
                'name' => $user->name,
                'email' => $user->email,
                'org_name' => $org->name,
                'status' => 'Accepted'
            );
            if (\Config::get('settings.environment') == 'production') {
                \Mail::queue('emails/org_join_request', $data, function ($message) use ($user) {
                    $message
                        ->from('noreply@pakblood.com', 'Pakblood')
                        ->to($user->email, $user->name)
                        ->subject('Request To Join Organization');
                });
            }
            $req->delete();
            return \Response::json([
                'responseMessage' => 'Request accepted.',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'Error! While updating request.',
            'responseCode' => -2
        ], 400);
    }

    /**
     * Get organization profile data (Eg users, request, country, city)
     *
     * @param $id
     *
     * @return mixed
     */
    public function getProfile($id) {
        if (\Auth::guest()) {
            $org = Org::whereIdAndStatus($id, 'active')->first();
            return \Response::json(['org' => $org], 200);
            //            return view::make('org_profile', compact('org'));
        }
        $org = Org::whereIdAndStatus($id, 'active', \Auth::user()->id)->first();
        if (!$org) {
            return \Response::json([
                'responseMessage' => 'Error! Organization not found or not active.',
                'responseCode' => -4
            ]);
        }
        $countryId = City::where('id', $org->city_id)->pluck('country_id');
        $users     = User::where('org_id', '=', $id)->where('id', '!=', \Auth::user()->id)->paginate(10);
        $reqs      = OrgRequests::join('pb_users', 'pb_org_join_requests.user_id', '=', 'pb_users.id')
            ->join('pb_org', 'pb_org_join_requests.org_id', '=', 'pb_org.id')
            ->select(\DB::raw('pb_users.*,pb_org_join_requests.id as req_id,pb_org_join_requests.reason'))
            ->where('pb_org.id', '=', $id)
            ->get();
        $orgCity   = $org->city_id;
        $orgCities = City::where('country_id', $countryId)->get();

        return \Response::json([
            'org' => $org,
            //                                   'orgCountry'   => $countryId,
            //                                   'orgCity'      => $orgCity,
            //                                   'cities'       => $orgCities,
            //                                   'users'        => $users,
            //                                   'reqs'         => $reqs,
            //                                   'responseCode' => 1
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

    /**
     * @param $orgId
     * @return mixed
     */
    public function delete($orgId) {
        //        dd($orgId);
        $org   = Org::find($orgId);
        $users = User::where('org_id', $orgId)->get();
        foreach ($users as $user) {
            $user->org_id = 0;
            $user->save();
        }
        if ($org->delete()) {
            return \Response::json([
                'responseMessage' => 'Org Successfully deleted',
                'responseCode' => 1
            ], 200);
        }
        return \Response::json([
            'responseMessage' => 'Problem deleting Org',
            'responseCode' => 0
        ], 400);
    }
}
