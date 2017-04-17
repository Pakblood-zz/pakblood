<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Org;
use App\OrgRequests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrgRequestsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request) {
        if ((OrgRequests::whereUser_idAndOrg_id(Auth::user()->id, $request->input('org_id'))->count()) > 0) {
            return redirect()->back()
                ->with('message', 'You have already sent a request to join this organization, please wait until organization admin approve your request.')
                ->with('type', 'error');
        }
        $org             = Org::find($request->input('org_id'));
        $orgreq          = new OrgRequests;
        $orgreq->user_id = Auth::user()->id;
        $orgreq->org_id  = $org->id;
        $orgreq->reason  = $request->input('reason');
        if ($orgreq->save()) {
            $data = [
                'name' => $org->admin_name,
                'email' => $org->email,
                'org' => $org->name,
                'member' => Auth::user()->name,
            ];
            if (\Config::get('settings.environment') == 'production') {
                Mail::send(['html' => 'emails/org_member_request'], $data, function ($message) use ($data) {
                    $message
                        ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                        ->subject('User Join Request.');
                });
            }
            return redirect()->back()
                ->with('message', 'Request successfully submitted, please wait for organization admin to approve your request.')
                ->with('type', 'success');
        }
        return redirect()->back()
            ->with('message', 'Error refresh and try again.')
            ->with('type', 'error');
    }

}
