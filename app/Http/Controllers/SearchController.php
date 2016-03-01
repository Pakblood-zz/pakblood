<?php

namespace App\Http\Controllers;

use App\City;
use App\Report;
use App\User;
use App\Org;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class SearchController extends Controller {

    public function getAllUsers(Request $request) {

        if ($request->input('page') != null) {
            $page = $request->input('page');
            $page--;
        }
        else {
            $page = 0;
        }

        $currPage = $page;
        $perPage = 15;

        $start = $currPage * $perPage;

        $totalrec = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
            ->selectraw('COUNT(pb_users.id) as tottalrec')->whereStatusAndOrg_idAndIs_deleted('active', 0, 0)
            ->where(DB::raw('(select count(p2.reported_user_id) from pb_user_reports as p2 where p2.reported_user_id = pb_users.id)'), '<', 2)
            ->first();

        $users = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
            ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
            ->addselect('pb_users.*')
            ->whereStatusAndOrg_idAndIs_deleted('active', 0, 0)
            ->having('report_count', '<', 2)->groupby('pb_users.id')->skip($start)->take(15)->get();

        $users = new LengthAwarePaginator(
            $users,
            $totalrec['tottalrec'],
            15,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        $data = array('users' => $users);
        return view::make('members', $data);
    }

    public function getSearchData(Request $request) {
//        dd($request->input());
        $bg = $request->input('bgroup');
        if (substr($bg, -1, 1) == 'p') {
            $bg = substr($bg, 0, -1) . '+';
        }
        if (substr($bg, -1, 1) == 'n') {
            $bg = substr($bg, 0, -1) . '-';
        }
        if (Auth::guest()) {
            if ($request->input('page') != null) {
                $page = $request->input('page');
                $page--;
            }
            else {
                $page = 0;
            }

            $currPage = $page;
            $perPage = 15;

            $start = $currPage * $perPage;

            $totalrec = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                ->selectraw('COUNT(pb_users.id) as tottalrec')->whereStatusAndOrg_idAndIs_deleted('active', 0, 0)
                ->where(DB::raw('(select count(p2.reported_user_id) from pb_user_reports as p2 where p2.reported_user_id = pb_users.id)'), '<', 2)
                ->first();

            $users = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
                ->addselect('pb_users.*')
                ->whereOrg_idAndIs_deleted(0, 0)->where('status', '!=', 'inactive')
                ->where('pb_users.city_id', $request->input('city'))
                ->having('report_count', '<', 2)->groupby('pb_users.id')->skip($start)->take(15)->get();

            $users = new LengthAwarePaginator(
                $users,
                count($users),
                15,
                Paginator::resolveCurrentPage(),
                ['path' => Paginator::resolveCurrentPath()]
            );
        }
        else {
            if ($request->input('page') != null) {
                $page = $request->input('page');
                $page--;
            }
            else {
                $page = 0;
            }

            $currPage = $page;
            $perPage = 15;

            $start = $currPage * $perPage;

            $totalrec = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                ->selectraw('COUNT(pb_users.id) as tottalrec')->whereStatusAndIs_deleted('active', 0)
                ->where('pb_users.id', '!=', Auth::user()->id)
                ->where(function ($query) {
                    $query->where('org_id', '=', 0)->orWhere('org_id', '=', Auth::user()->org_id);
                })
                ->where(DB::raw('(select count(p2.reported_user_id) from pb_user_reports as p2 where p2.reported_user_id = pb_users.id)'), '<', 2)
                ->first();

            $users = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
                ->addselect('pb_users.*')
                ->whereStatusAndIs_deleted('active', 0)
                ->where('pb_users.id', '!=', Auth::user()->id)
                ->where(function ($query) {
                    $query->where('org_id', '=', 0)->orWhere('org_id', '=', Auth::user()->org_id);
                })
                ->having('report_count', '<', 2)->groupby('pb_users.id')->skip($start)->take(15)->get();

            $users = new LengthAwarePaginator(
                $users,
                count($users),
                15,
                Paginator::resolveCurrentPage(),
                ['path' => Paginator::resolveCurrentPath()]
            );
        }
//        dump($users);
//        dd();
        $data = array('users'   => $users, 'bg' => $request->input('bgroup'),
                      'country' => $request->input('country'), 'city' => $request->input('city'),
                      'cities'  => City::where('country_id', $request->input('country'))->get(),
                      'orgs'    => Org::join('pb_users', 'pb_users.org_id', '=', 'pb_org.id')
                          ->select(DB::raw('Count(pb_users.id) as total_users,pb_org.id,pb_org.name'))
                          ->where('pb_users.blood_group', '=', $bg)
                          ->where('pb_users.status', '=', 'active')
                          ->where('pb_org.status', '=', 'active')
                          ->where('pb_org.city_id', '=', $request->input('city'))
                          ->groupBy('pb_org.id')->get());
        return view::make('members', $data);
    }

    public function getCities($country_id) {
        $cities = City::where('country_id', $country_id)->get();
        return \Response::json(['status' => 1, 'cities' => $cities]);
    }
}
