<?php

namespace App\Http\Controllers\Api\V2;

use App\BleedRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BleedRequestsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $result = BleedRequest::get();

        $responseMessage = "Success";
        $responseCode    = 1;

        return \Response::json([
            'result' => $result,
            'responseMessage' => $responseMessage,
            'responseCode' => $responseCode
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $bleedRequest = BleedRequest::create($request->input());

        if ($bleedRequest) {
            return \Response::json([
                'bleedRequest' => $bleedRequest,
                'responseMessage' => "Success, Bleed Request added.",
                'responseCode' => 1
            ], 200);
        } else {
            return \Response::json([
                'responseMessage' => "Failed, Error while adding bleed request.",
                'responseCode' => -1
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $result = BleedRequest::find($id);

        if ($result) {
            return \Response::json([
                'result' => $result,
                'responseMessage' => "Success",
                'responseCode' => 1
            ], 200);
        } else {
            return \Response::json([
                'responseMessage' => "Failed, No record found.",
                'responseCode' => -4
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $result = BleedRequest::find($id);

        $result->update($request->input());

        if ($result) {
            return \Response::json([
                'result' => $result,
                'responseMessage' => "Success",
                'responseCode' => 1
            ], 200);
        } else {
            return \Response::json([
                'responseMessage' => "Failed, No record found.",
                'responseCode' => -4
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $result = BleedRequest::find($id);

        if ($result) {
            if ($result->delete()) {
                return \Response::json([
                    'responseMessage' => "Success, Record Deleted.",
                    'responseCode' => 1
                ], 200);
            } else {
                return \Response::json([
                    'responseMessage' => "Failed, Error while deleting record.",
                    'responseCode' => -1
                ], 400);
            }
        } else {
            return \Response::json([
                'responseMessage' => "Failed, No record found.",
                'responseCode' => -4
            ], 400);
        }
    }
}
