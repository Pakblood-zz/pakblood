<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpline;

class HelplinesController extends Controller
{
    public function index(){
        $data = array('dirs' => Helpline::select('*')->paginate(15),
            'city_id' => '');
        return view('helplines',$data);
    }
    public function filterData(Request $request){
        $data = array('dirs' => Helpline::select('*')->where('city_id','=',$request->city_id)->paginate(15),
            'city_id' => $request->city_id);
        return view('helplines',$data);
    }
}
