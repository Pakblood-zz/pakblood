<?php

namespace App\Http\Controllers\Admin;

use App\Bleed;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class BleedController extends Controller
{
    public function index($id){
        $data = array('user' => User::where('id','=',$id)->first());
        return view('admin.add_bleed',$data);
    }
    public function getAll($id){
        $data = array('bleed' => Bleed::where('user_id','=',$id)->paginate(15),
            'user' => User::where('id','=',$id)->first(),
            'type' => 'view');
        return view('admin.bleed',$data);
    }

    public function edit($user_id , $bleed_id){
        $data = array('bleed' => Bleed::where('id','=',$bleed_id)->first(),
            'user' => User::where('id','=',$user_id)->first(),
            'type' => 'edit');
        return view('admin.bleed',$data);
    }
    public function update(Request $request){
        $bleed = Bleed::where('id','=',$request->input('bleed_id'))->first();
        $bleed->user_id = $request->input('user_id');
        $bleed->receiver_name = $request->input('receiver_name');
        $bleed->city = $request->input('city');
        $bleed->comments = $request->input('comments');
        $bleed->date = date('y-m-d',strtotime($request->input('date')));
        if($bleed->save()){
            return redirect('/admin/user/'.$request->input('user_id').'/bleed/history')
                ->with('message', 'Bleed status successfuly update')
                ->with('type','success');
        }
        return redirect()->back()
            ->with('message', 'There was some problems updating bleed status')
            ->with('type','error');
    }
    public function add(Request $request){
        $rules = array(
            'receiver_name' => 'required',
            'city' => 'required',
            'date' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->fails()) {
            return Redirect()->back()
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $bleed = new Bleed;
            $bleed->user_id = $request->input('user_id');
            $bleed->receiver_name = $request->input('receiver_name');
            $bleed->city = $request->input('receiver_name');
            $bleed->comments = $request->input('receiver_name');
            $bleed->date = date('y-m-d', strtotime($request->input('date')));
            $user = User::where('id','=',$request->input('user_id'))
                ->update(['last_bleed' => date('y-m-d', strtotime($request->input('date')))]);


            if($bleed->save()){
                return redirect('/admin/user/'.$request->input('user_id').'/bleed/history')
                    ->with('message','Bleed status succesfully added')
                    ->with('type','success');
            }
        }
    }
}
