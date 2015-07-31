<?php

namespace App\Http\Controllers;

use App\User;
use App\Org;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class SearchController extends Controller
{

    public function getAllUsers(){
        $data = array('users' =>  User::whereStatusAndOrg_id('active', 0)->paginate(15));
        return view::make('members',$data);
    }

    public function getSearchData(Request $request){
        $bg = $request->input('bgroup');
        if (substr($bg, -1, 1) == 'p') {
            $bg = substr($bg, 0, -1) . '+';
        }
        if (substr($bg, -1, 1) == 'n') {
            $bg = substr($bg, 0, -1) . '-';
        }
        $user = User::whereBlood_groupAndCity_idAndStatus($bg, $request->input('city'),'active')
            ->where('id','!=',Auth::user()->id)
            ->where(function($query){
                $query->where('org_id','=',0)->orWhere('org_id','=',Auth::user()->org_id);
            })->paginate(15);
        $data = array('users' => $user,
            'bg' => $request->input('bgroup'),'city' => $request->input('city'),
            'orgs' => Org::join('pb_users','pb_users.org_id', '=','pb_org.id')
                ->select(DB::raw('Count(pb_users.id) as total_users,pb_org.id,pb_org.name'))
                ->where('pb_users.blood_group', '=', $bg)
                ->where('pb_users.status', '=', 'active')
                ->where('pb_org.status', '=', 'active')
                ->where('pb_org.city_id', '=', $request->input('city'))
                ->groupBy('pb_org.id')->get());
        return view::make('members',$data);
    }
}
