<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Org;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function getAllUsers(Request $request)
    {
        if ($request->input('page') != NULL) {
            $page = $request->input('page');
            $page--;
        } else {
            $page = 0;
        }

        $currPage = $page;
        $perPage = 15;

        $start = $currPage * $perPage;

        $totalrec = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                        ->selectraw('COUNT(pb_users.id) as tottalrec')->whereStatusAndOrg_idAndIs_deleted('active', 0,
                                                                                                          0)
                        ->where(\DB::raw('(select count(p2.reported_user_id) from pb_user_reports as p2 where p2.reported_user_id = pb_users.id)'),
                                '<', 2)
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
        $data = $users;
        return \Response::json(compact('data'), 200);
    }

    public function getSearchData(Request $request)
    {
        $input = $request->input();
        $bg = $input['bgroup'];
        $country = $input['country'];
        $city = $input['city'];
//        dump($bg);
//        dump($city);
//        dd($input);
        if (\Auth::guest()) {
            if ($input->get('page') != NULL) {
                $page = $request->input('page');
                $page--;
            } else {
                $page = 0;
            }

            $currPage = $page;
            $perPage = 15;

            $start = $currPage * $perPage;

            /* $totalrec = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                 ->selectraw('COUNT(pb_users.id) as tottalrec')->whereStatusAndOrg_idAndIs_deleted('active', 0, 0)
                 ->where(DB::raw('(select count(p2.reported_user_id) from pb_user_reports as p2 where p2.reported_user_id = pb_users.id)'), '<', 2)
                 ->first();*/
            $totalrec = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                            ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
                            ->addselect('pb_users.*')
                            ->whereOrg_idAndIs_deleted(0, 0)->where('status', 'active')
                            ->where(function ($query) {
                                $query->where('phone', '!=', '')
                                      ->whereOr('mobile', '!=', '');
                            })
                            ->where('pb_users.city_id', $city)
                            ->where('pb_users.blood_group', $bg)
                            ->having('report_count', '<', 2)->groupby('pb_users.id')->get();

            $users = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                         ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
                         ->addselect('pb_users.*')
                         ->whereOrg_idAndIs_deleted(0, 0)->where('status', 'active')
                         ->where(function ($query) {
                             $query->where('phone', '!=', '')
                                   ->whereOr('mobile', '!=', '');
                         })
                         ->where('pb_users.city_id', $city)
                         ->where('pb_users.blood_group', $bg)
                         ->whereRaw('pb_users.last_bleed < DATE_SUB(NOW(),INTERVAL 3 month)')
                         ->having('report_count', '<', 2)->groupby('pb_users.id')->skip($start)->take(15)->get();
//            dump($users);
//            dump($totalrec);
//            dd();
            $users = new LengthAwarePaginator(
                $users,
                count($totalrec),
                15,
                Paginator::resolveCurrentPage(),
                ['path' => Paginator::resolveCurrentPath()]
            );
        } else {
            if ($request->input('page') != NULL) {
                $page = $request->input('page');
                $page--;
            } else {
                $page = 0;
            }

            $currPage = $page;
            $perPage = 15;

            $start = $currPage * $perPage;

            /*$totalrec = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                ->selectraw('COUNT(pb_users.id) as tottalrec')->whereStatusAndIs_deleted('active', 0)
                ->where('pb_users.id', '!=', Auth::user()->id)
                ->where(function ($query) {
                    $query->where('org_id', '=', 0)->orWhere('org_id', '=', Auth::user()->org_id);
                })
                ->where(DB::raw('(select count(p2.reported_user_id) from pb_user_reports as p2 where p2.reported_user_id = pb_users.id)'), '<', 2)
                ->first();*/

            $totalrec = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                            ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
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
                            ->where('pb_users.city_id', $city)
                            ->where('pb_users.blood_group', $bg)
                            ->having('report_count', '<', 2)->groupby('pb_users.id')->get();

            $users = User::leftjoin('pb_user_reports', 'pb_users.id', '=', 'pb_user_reports.reported_user_id')
                         ->selectraw('COUNT(pb_user_reports.reported_user_id) as report_count')
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
                         ->where('pb_users.city_id', $city)
                         ->where('pb_users.blood_group', $bg)
                         ->having('report_count', '<', 2)->groupby('pb_users.id')->skip($start)->take(15)->get();

           /* $users = new LengthAwarePaginator(
                $users,
                count($totalrec),
                15,
                Paginator::resolveCurrentPage(),
                ['path' => Paginator::resolveCurrentPath()]
            );*/
        }
//        dd($users);
        $data = array(
            'users' => $users,
            'bg' => $bg,
            'country' => $country,
            'city' => $city,
            'cities' => City::where('country_id', $request->input('country'))->get(),
            'orgs' => Org::join('pb_users', 'pb_users.org_id', '=', 'pb_org.id')
                         ->select(\DB::raw('Count(pb_users.id) as total_users,pb_org.id,pb_org.name'))
                         ->where('pb_users.blood_group', '=', $bg)
                         ->where('pb_users.status', '=', 'active')
                         ->where('pb_org.status', '=', 'active')
                         ->where('pb_org.city_id', '=', $request->input('city'))
                         ->groupBy('pb_org.id')->get()
        );
        return \Response::json(compact('data'), 200);
    }

    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return \Response::json(['status' => 1, 'cities' => $cities]);
    }
}
