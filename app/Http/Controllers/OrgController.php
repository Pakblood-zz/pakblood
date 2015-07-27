<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Org;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('add_org');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name' => 'required|unique:pb_org',
            'org_address' => 'required',
            'org_phone' => 'required',
            'admin_name' => 'required|unique:pb_org'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('org')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $org = new Org;
            $org->user_id = Auth::user()->id;
            $org->username = Input::get('admin_username');
            $org->name = Input::get('name');
            $org->address = Input::get('org_address');
            $org->phone = Input::get('org_phone');
            $org->mobile = Input::get('admin_phone');
            $org->city_id = Input::get('city_id');
            //$org->image = Input::get('org_logo');
            //$org->application_image = Input::get('org_application');
            $org->admin_name = Input::get('admin_name');
            $org->program = Input::get('admin_program');
            $org->email = Input::get('admin_email');
            $org->url = Input::get('org_url');
            $org->save();
            DB::table('pb_users')
                ->where('id', Auth::user()->id)
                ->update(['org_id' => $org->id]);

            if ($org->save()) {
                $data = array(
                    'username' => Auth::user()->username,
                    'email' => Auth::user()->email,
                    'org_name' => Input::get('name')
                );
                Mail::queue('emails/register_org_request', $data, function ($message) use ($org) {
                    $message
                        ->from('noreply@pakblood.com', 'Pakblood')
                        ->to(Auth::user()->email, Auth::user()->name)
                        ->subject('Organization Registration');
                });
                return Redirect::to('profile/'.Auth::user()->username)->with('message', 'Organization registration successful, Your organization will be active after Pakblood admin review!!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getProfile($id)
    {
        $data = array('org' => Org::whereIdAndUser_id($id, Auth::user()->id)->first());
        return view::make('org_profile',$data);
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
    public function update(Request $request)
    {
        $org = Org::where('id', '=' , $request->input('org_id'))->first();
        $org->username = $request->Input('admin_username');
        $org->name = $request->Input('org_name');
        $org->address = $request->Input('org_address');
        $org->phone = $request->Input('org_phone');
        $org->mobile = $request->Input('admin_phone');
        $org->city_id = $request->Input('city_id');
        //$org->image = Input::get('org_logo');
        //$org->application_image = Input::get('org_application');
        $org->admin_name = $request->Input('admin_name');
        $org->program = $request->Input('admin_program');
        $org->email = $request->Input('admin_email');
        $org->url = Input::get('org_url');
        $org->save();
        if($org->save()){
            return Redirect::to('organization/'.$request->input('org_id'))->with('message', 'Organization Profile Successfully Updated!!');
        }
        return Redirect::to('organization/'.$request->input('org_id'))->with('message', 'There was some Problems Saving Organization Profile please try again. ');
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
