<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReportsController extends Controller {
    public function index(Request $request) {
        $data = array('id' => $request->input('id'));
        Return view('report_user', $data);
    }

    public function reportUser(Request $request) {
        if (Auth::user()) {
            $report = Report::whereReported_user_idAndReporter_user_id($request->input('id'), Auth::user()->id)->first();
            if (count($report) > 0) {
                return redirect()->back()->with('message', 'You have already reported that user, please wait for our admin team to review your report')->with('type', 'error');
            }
            $reporter = [
                'email' => Auth::user()->email,
                'name'  => Auth::user()->name
            ];
        }
        else {
            $report = Report::whereReported_user_idAndReporter_user_ip($request->input('id'), \Request::ip())->first();
            if (count($report) > 0) {
                return redirect()->back()->with('message', 'You have already reported that user, please wait for our admin team to review your report')->with('type', 'error');
            }
            $reporter = [
                'email' => $request->input('email'),
                'name'  => $request->input('name')
            ];
        }
        $report = new Report;
        $report->reported_user_id = $request->input('id');
        if (Auth::user()) {
            $report->reporter_user_id = Auth::user()->id;
        }
        else $report->reporter_user_ip = \Request::ip();
        $report->reporter_name = $request->input('name');
        $report->reporter_email = $request->input('email');
        $report->type = $request->input('report_type');
        $report->reporter_message = $request->input('comments');
//        dump($request->input());
        $user = User::find($request->input('id'));
//        dd($user);
        if ($report->save()) {
            $data = [
                'email'  => $user->email,
                'name'   => $user->name,
                'reason' => $request->input('report_type'),
                'msg'    => $request->input('comments')
            ];
//            dump($data['msg']);
            Mail::send(['html' => 'emails/user_reported'], $data, function ($message) use ($data) {
                $message
                    ->to($data['email'], $data['name'])->cc('info@pakblood.com')
                    ->subject('Account Reported.');
            });
            Mail::send(['html' => 'emails/thank_you_for_reporting'], $reporter, function ($message) use ($reporter) {
                $message
                    ->to($reporter['email'], $reporter['name'])->cc('info@pakblood.com')
                    ->subject('Thank you for reporting user on Pakblood.');
            });
            return redirect()->back()->with('message', 'User successfully reported')->with('type', 'success');
        }
        return redirect()->back()->with('message', 'There was some problems reporting user please try agian')->with('type', 'error');
    }
}
