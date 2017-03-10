<?php

namespace App\Http\Controllers\Admin;

use App\Bleed;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PictorialController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = User::join('pb_bleed_details', 'pb_users.id', '=', 'pb_bleed_details.user_id')
            ->where('pb_bleed_details.is_approved', '0')
            ->select('pb_users.name', 'pb_bleed_details.*')->paginate();
        //        dd($data);
        return view('admin.pictorial.index', compact('data'));
    }

    public function approve($id) {
        $bleed              = Bleed::find($id);
        $bleed->is_approved = 1;

        if ($bleed->save()) {
            return \Redirect::to('admin/pictorial')->with('message', 'Bleed Status Successfully Approved!!')
                ->with('type', 'success');
        }
        return \Redirect::to('admin/pictorial')->with('message', 'Error Approving Bleed Status.')
            ->with('type', 'error');
    }
}
