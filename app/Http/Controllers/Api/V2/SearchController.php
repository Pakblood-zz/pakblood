<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class SearchController extends Controller {

    public function getSearchData(Request $request) {
        $input     = $request->input();
        $bg        = $input['blood_group'];
        $latitude  = $input['latitude'];
        $longitude = $input['longitude'];
        $radius    = $input['radius'];
        //        dd($input);
        if (\Auth::guest()) {

            $users = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
                ->selectraw('(6371 * acos(cos( radians( 31.5132714 ) ) * cos( radians( `latitude` ) ) * cos(radians( `longitude` ) - radians( 74.3445707 ) ) + sin(radians(31.5132714)) * sin(radians(`latitude`)) ) ) `distance`')
                ->addselect('pb_users.*')
                ->whereOrg_idAndIs_deleted(0, 0)->where('status', 'active')
                ->where(function ($query) {
                    $query->where('phone', '!=', '')
                        ->whereOr('mobile', '!=', '');
                })
                //                ->where('pb_users.city_id', $city)
                ->where('pb_users.blood_group', $bg)
                ->whereRaw('pb_users.last_bleed < DATE_SUB(NOW(),INTERVAL 3 month)')
                ->having('report_count', '<', 2)->having('distance', '<', $radius)->groupby('pb_users.id')
                //                ->toSql();
                ->get();

        } else {
            $users = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
                ->selectraw('(6371 * acos(cos( radians( 31.5132714 ) ) * cos( radians( `latitude` ) ) * cos(radians( `longitude` ) - radians( 74.3445707 ) ) + sin(radians(31.5132714)) * sin(radians(`latitude`)) ) ) `distance`')
                ->addselect('pb_users.*')
                ->whereStatusAndIs_deleted('active', 0)
                ->where('pb_users.id', '!=', \Auth::user()->id)
                ->where(function ($query) {
                    $query->where('org_id', '=', 0)->orWhere('org_id', '=', \Auth::user()->org_id);
                })
                ->where(function ($query) {
                    $query->where('phone', '!=', '')
                        ->whereOr('mobile', '!=', '');
                })
                //                ->where('pb_users.city_id', $city)
                ->where('pb_users.blood_group', $bg)
                ->having('report_count', '<', 2)->having('distance', '<', $radius)->groupby('pb_users.id')
                //                ->toSql();
                ->get();

        }

        $responseMessage = 'Success';
        $responseCode    = 1;

        if (count($users) == 0) {
            $responseMessage = 'No Record found.';
            $responseCode    = -4;
        }

        return \Response::json([
            'users' => $users,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'blood_group' => $bg,
            'radius' => $radius,
            'responseMessage' => $responseMessage,
            'responseCode' => $responseCode
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
