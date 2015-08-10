<?php

namespace App\Http\Controllers\Admin;

use App\Org;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function getAll(){
        $data = array('users' => User::select('*')->where('is_deleted','=',0)->paginate(15));
        return view('admin.users',$data);
    }

    public function filter(Request $request){
        if($request->input('status') == 'all' && $request->input('email') == null){
            $data = array('users' => User::select('*')->where('is_deleted','=',$request->input('is_deleted'))->paginate(15),
                'email' => $request->input('email'), 'status' => $request->input('status'),'type' => $request->input('type'));
            return view('admin.users',$data);
        }
        elseif($request->input('email') != NULL){
            if($request->input('status') == 'all'){
                $data = array('users' => User::where('email','=',$request->input('email'))
                    ->where('is_deleted','=',$request->input('is_deleted'))->paginate(15),
                    'email' => $request->input('email'), 'status' => $request->input('status'),'type' => $request->input('type'));
                return view('admin.users',$data);
            }
            $data = array('users' => User::whereEmailAndStatus($request->input('email'),$request->input('status'))
                ->where('is_deleted','=',$request->input('is_deleted'))->paginate(15),
                'email' => $request->input('email'), 'status' => $request->input('status'),'type' => $request->input('type'));
            return view('admin.users',$data);
        }
        $data = array('users' => User::where('status','=',$request->input('status'))
            ->where('is_deleted','=',$request->input('is_deleted'))->paginate(15),
            'email' => $request->input('email'), 'status' => $request->input('status'),'type' => $request->input('type'));
        return view('admin.users',$data);
    }

    public function getUser($id){
        $user = User::where('id','=',$id)->first();
        $org = Org::where('id','=',$user->org_id)->first();
        $city = Org::join('pb_cities','pb_org.city_id','=','pb_cities.id')
            ->select(DB::raw('pb_cities.*'))
            ->where('pb_cities.id', '=', '208')
            ->first();
        $data = array('user' => $user,'city' => $city,'org' => $org,'type' => 'view');
        return view('admin.user_profile',$data);
    }

    public function edit($id){
        $user = User::where('id','=',$id)->first();
        $org = Org::where('id','=',$user->org_id)->first();
        $city = Org::join('pb_cities','pb_org.city_id','=','pb_cities.id')
            ->select(DB::raw('pb_cities.*'))
            ->where('pb_cities.id', '=', '208')
            ->first();
        $data = array('user' => $user,'city' => $city,'org' => $org,'type' => 'edit');
        $data['user']['dob'] = date('d-M-y', strtotime($data['user']['dob']));
        $data['user']['last_bleed'] = date('d-M-y', strtotime($data['user']['last_bleed']));
        return view('admin.user_profile',$data);
    }

    public function update(Request $request){
        $user = User::where('id','=',$request->input('id'))->first();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->dob = date('y-m-d', strtotime($request->input('dob')));
        $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');
        $user->address = $request->input('address');
        $user->city_id = $request->input('city_id');
        $user->blood_group = $request->input('bgroup');
        $user->status = $request->input('status');
        if($user->save()){
            return Redirect::to('/admin/edit/user/'.$request->input('id'))->with('message', 'User data successfully updated!')->with('type','success');
        }
        return Redirect::to('/admin/edit/user/'.$request->input('id'))->with('message', 'There was some problems saving user data please try again.')->with('type','error');
    }
    public function changeStatus($id){
        $user = User::where('id','=',$id)->first();
        if($user->status == 'active'){
            $user->status = 'inactive';
            $user->save();
            return redirect()->back()->with('message', 'User status changed to inactive!')->with('type','success');
        }
        else{
            $user->status = 'active';
            $user->save();
            return redirect()->back()->with('message', 'User status changed to active!')->with('type','success');
        }
    }
    public function add(Request $request){
        $rules = array(
            'name' => 'required',
            'username' => 'required|unique:pb_users',
            'email' => 'required|unique:pb_users',
            'password' => 'required|confirmed',
        );
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->fails()) {
            return Redirect('/admin/add/user')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $user = new User;
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->gender = $request->input('gender');
            $user->dob = date('y-m-d', strtotime($request->input('dob')));
            $user->phone = $request->input('phone');
            $user->mobile = $request->input('mobile');
            $user->address = $request->input('address');
            $user->city_id = $request->input('city');
            $user->blood_group = $request->input('bgroup');
            $user->status = $request->input('status');
            if($user->save()){
                return redirect('/admin/add/user')
                    ->with('message', 'User successfully added')
                    ->with('type', 'success');
            }
            return redirect('/admin/add/user')
                ->with('message', 'There was some problem adding user')
                ->with('type', 'error');
        }
    }

    public function getDeleted(Request $request){
        $data = array('users' => User::select('*')->where('is_deleted','=',1)->paginate(15),
            'type' => 'deleted');
        return view('admin.users',$data);
    }

    public function delete($id){
        $user = User::where('id','=',$id)->first();
        $org = Org::where('user_id','=',$id)->first();
        if($org == null){
            $user->is_deleted = 1;
            if($user->save()){
                return redirect('/admin/users')->with('message','User account successfully deleted')->with('type','success');
            }
        }
        return redirect()->back()->with('message','User account can\'t be deactivated until user is admin of an organization. ')->with('type','error');
    }


    public function undoDelete($id){
        $user = User::where('id','=',$id)->first();
        $pass = str_random(16);
        $user->is_deleted = 0;
        $user->password = bcrypt($pass);
        if($user->save()){
            $data = array(
                'name' => $user->name,
                'email' => $user->email,
                'password' => $pass
            );
            Mail::queue('emails/re_join', $data, function ($message) use ($user) {
                $message
                    ->from('noreply@pakblood.com', 'Pakblood')
                    ->to($user->email, $user->name)
                    ->subject('Account Activated');
            });
            return redirect('/admin/users')->with('message','User account undone deleted. ')->with('type','success');
        }
        return redirect('/admin/users')->with('message','Their was some problems undo deleting user')->with('type','success');
    }
}
