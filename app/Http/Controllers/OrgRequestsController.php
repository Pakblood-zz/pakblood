<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Org;
use App\OrgRequests;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrgRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if((OrgRequests::whereUser_idAndOrg_id(Auth::user()->id , $request->input('org_id'))->count()) > 0){
            return redirect()->back()
                ->with('message', 'You have already sent a request to join this organization, please wait until organization admin approve your request.')
                ->with('type','error');
        }
        $orgreq = new OrgRequests;
        $orgreq->user_id = Auth::user()->id;
        $orgreq->org_id = $request->input('org_id');
        $orgreq->reason = $request->input('reason');
        $orgreq->save();
        return redirect()->back()
        ->with('message', 'Request successfully submitted, please wait for organization admin to approve your request.')
        ->with('type','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
