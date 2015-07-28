<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bleed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BleedController extends Controller
{
    public function update(Request $request){
        $bleed = new Bleed;
        $bleed->user_id = Auth::user()->id;
        $bleed->receiver_name = $request->input('receiver_name');
        $bleed->city = $request->input('city');
        $bleed->comments = $request->input('comments');
        $bleed->date = $request->input('date');

        if($bleed->save()){
            return Redirect::to('profile/'.Auth::user()->username)->with('message', 'Bleed Status Successfully Updated!!');
        }
        return Redirect::to('profile/'.Auth::user()->username)->with('message', 'There was some problems updating bleed status');
    }
}
