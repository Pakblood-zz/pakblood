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
            //            ->where('pb_bleed_details.is_approved', '0')
            ->orderBy('image', 'DESC')->orderBy('id', 'DESC')
            ->select('pb_users.name', 'pb_bleed_details.*')->paginate();
        //        dd($data);
        return view('admin.pictorial.index', compact('data'));
    }

    public function updateApproval(Request $request) {
        //        dd($request->input());
        $ids        = $request->input('ids');
        $isApproved = $request->input('isApproved');
        if (!is_array($ids)) {
            $bleed              = Bleed::find($ids);
            $bleed->is_approved = $isApproved;

            if ($bleed->save()) {
                return \Response::json(['ids' => $ids, 'isApproved' => $isApproved,
                    'message' => 'Bleed Status Approval Successfully Updated!!', 'type' => 'success']);
            }
            return \Response::json(['message' => 'Error Approving Bleed Status.', 'type' => 'error']);
        } else {
            $flag = 0;
            foreach ($ids as $id) {
                $bleed              = Bleed::find($id);
                $bleed->is_approved = $isApproved;
                if ($bleed->save()) {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
            }
            if ($flag) {
                return \Response::json(['ids' => $ids, 'isApproved' => $isApproved,
                    'message' => 'Bleed Status Approval Successfully Updated!!', 'type' => 'success']);
            }
            return \Response::json(['message' => 'Error Approving Bleed Status.', 'type' => 'error']);
        }
    }
}
