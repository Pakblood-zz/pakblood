<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index(Request $request){
        $data = array('id' => $request->input('id'));
        Return view('report_user',$data);
    }
    public function reportUser(Request $request){
        $report = Report::whereReported_user_idAndReporter_user_id($request->input('id'),Auth::user()->id)->first();
        if(count($report) > 0){
            return redirect()->back()->with('message','You have already reported that user, please wait for our admin team to review your report')->with('type','error');
        }
        $report = new Report;
        $report->reported_user_id = $request->input('id');
        $report->reporter_user_id = Auth::user()->id;
        $report->reporter_name = $request->input('name');
        $report->reporter_email = $request->input('email');
        $report->type = $request->input('report_type');
        $report->reporter_message = $request->input('comments');
        if($report->save()){
            return redirect()->back()->with('message','User successfully reported')->with('type','success');
        }
        return redirect()->back()->with('message','There was some problems reporting user please try agian')->with('type','error');
    }
}
