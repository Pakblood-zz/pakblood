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
use Illuminate\Support\Facades\Validator;

class OrgController extends Controller
{
    public function getAll(){
        $data = array('orgs' => Org::select('*')->paginate());
        return view('admin.organizations',$data);
    }

    public function getOrg($id){
        $org = Org::where('id','=',$id)->first();
        $city = Org::join('pb_cities','pb_org.city_id','=','pb_cities.id')
            ->select(DB::raw('pb_cities.*'))
            ->where('pb_cities.id', '=', '208')
            ->first();

        $data = array('org' => $org,'city' => $city,'type' => 'view');
        return view('admin.org_profile',$data);
    }

    public function editOrg($id){
        $data = array('org' => Org::where('id','=',$id)->first(), 'type' => 'edit');
        return view('admin.org_profile',$data);
    }

    public function filter(Request $request){
        if($request->input('status') == 'all' && $request->input('email') == null){
            $data = array('users' => User::select('*')->paginate(15),
                'email' => $request->input('email'), 'status' => $request->input('status'));
            return view('admin.users',$data);
        }
        elseif($request->input('email') != NULL){
            if($request->input('status') == 'all'){
                $data = array('orgs' => Org::where('email','=',$request->input('email'))->paginate(15),
                    'email' => $request->input('email'), 'status' => $request->input('status'));
                return view('admin.organizations',$data);
            }
            $data = array('orgs' => Org::whereEmailAndStatus($request->input('email'),$request->input('status'))->paginate(15),
                'email' => $request->input('email'), 'status' => $request->input('status'));
            return view('admin.organizations',$data);
        }
        $data = array('orgs' => Org::where('status','=',$request->input('status'))->paginate(15),
            'email' => $request->input('email'), 'status' => $request->input('status')
        );
        return view('admin.organizations',$data);
    }

    public function add(Request $request){
        $rules = array(
            'name' => 'required|unique:pb_org',
            'org_address' => 'required',
            'org_phone' => 'required',
            'city' => 'required',
            'username' => 'required|exists:pb_users,username,org_id,0',
        );

        $messages = [
            'username.exists' => 'Username Does not exist in database or is already a part of an organization.'
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect('/admin/add/organization')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            $org = new Org;
            $user = User::where('username','=',$request->input('username'))->first();
            if($user->is_deleted == 1 || $user->status == 'inactive'){
                return redirect()->back()->withInput(Input::all())
                    ->with('message','User with Deactivated account can\'t be admin of an organization or user have not yet confirmed their email.')
                    ->with('type','error');
            }elseif($user->status == 'reported'){
                return redirect()->back()->withInput(Input::all())
                    ->with('message','Reported users can\'t be admin of an organizaiton')
                    ->with('type','error');
            }
            $org->user_id = $user->id;
            $org->username = $user->username;
            $org->name = $request->input('name');
            $org->address = $request->input('org_address');
            $org->url = $request->input('url');
            $org->phone = $request->input('org_phone');
            $org->mobile = $user->mobile;
            $org->city_id = $request->input('city');
            if ($request->hasFile('logo'))
            {
                $logo = $org->name . '.' .
                    $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(
                    base_path() . '/public/images/logos/', $logo
                );
                $org->image = $logo;
            }
            $org->admin_name = $user->name;
            $org->email = $user->email;
            $org->status = 'active';
            if($org->save()){
                DB::table('pb_users')
                    ->where('id', $user->id)
                    ->update(['org_id' => $org->id]);
                return redirect('/admin/organizations')
                    ->with('message','Organization successfully created.')
                    ->with('type','success');
            }
            return redirect()->back()->withInput(Input::all())
                ->with('message','There was some probems with creating organizaiton.')
                ->with('type','error');
        }
    }

    public function delete($id){
        $org = Org::where('id','=',$id);
        $users = User::where('org_id','=',$id)->get();
        foreach($users as $user){
            $user->org_id = 0;
            $user->save();
        }
        if($org->delete()){
            return redirect('/admin/organizations')
                ->with('message','Organization successfully deleted.')
                ->with('type','success');
        }
        return redirect('/admin/organizations')
            ->with('message','there was some problem deleting Organization.')
            ->with('type','error');
    }

    public function update(Request $request){
        $user = User::whereUsernameAndEmail($request->input('admin_username'),$request->input('admin_email'))->first();
        if($user->is_deleted == 1 || $user->status == 'inactive'){
            return redirect()->back()->withInput(Input::all())
                ->with('message','User with Deactivated account can\'t be admin of an organization or user have not yet confirmed their email.')
                ->with('type','error');
        }elseif($user->status == 'reported'){
            return redirect()->back()->withInput(Input::all())
                ->with('message','Reported users can\'t be admin of an organizaiton')
                ->with('type','error');
        }
        $org = Org::where('id','=',$request->input('org_id'))->first();
        $org->user_id = $user->id;
        $org->username = $user->username;
        $org->name = $request->input('org_name');
        $org->address = $request->input('org_address');
        $org->url = $request->input('url');
        $org->phone = $request->input('org_phone');
        $org->mobile = $user->mobile;
        $org->city_id = $request->input('city');
        if ($request->hasFile('logo'))
        {
            $logo = $org->name . '.' .
                $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(
                base_path() . '/public/images/logos/', $logo
            );
            $org->image = $logo;
        }
        $org->admin_name = $user->name;
        $org->email = $user->email;
        $org->status = $request->input('status');
        if($org->save()){
            DB::table('pb_users')
                ->where('id', $user->id)
                ->update(['org_id' => $org->id]);
            return redirect('/admin/edit/organization/'.$org->id)
                ->with('message','Organization successfully edited.')
                ->with('type','success');
        }
        return redirect()->back()->withInput(Input::all())
            ->with('message','There was some problems with editing organization.')
            ->with('type','error');
    }

    public function changeStatus($id){
        $org = Org::Where('id','=',$id)->first();
        if($org->status == 'active'){
            $org->status = 'inactive';
            $org->save();
        }else{
            $org->status = 'active';
            $org->save();
            $data = array(
                'name' => $org->admin_name,
                'org_name' => $org->name,
                'status' => 'Accepted'
            );
            Mail::queue('emails/org_create_request', $data, function ($message) use ($org) {
                $message
                    ->to($org->email , $org->admin_name)
                    ->subject('Organization Create Request');
            });
        }
        return redirect('/admin/organizations')->with('message','Organization status successfully changed.')->with('type','success');
    }
}
