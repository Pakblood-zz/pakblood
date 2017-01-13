<?php

namespace App\Http\Controllers\Admin;

use App\Org;
use App\Report;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReportsController extends Controller
{
    public function getAll()
    {
        $users = User::join('pb_user_reports', 'pb_user_reports.reported_user_id', '=', 'pb_users.id')
                     ->select(DB::raw('pb_users.id as user_id,pb_users.*'))->groupby('pb_users.id')->get();
        $reports = [];
        foreach ($users as $user) {
            $reports[] = Report::where('reported_user_id', '=', $user->user_id)->get();
        }

        $data = array('users' => $users, 'reports' => $reports);
        return view('admin.reports', $data);
    }

    public function deleteReportedUser($id)
    {
        $user = User::find($id);
        $org = Org::where('user_id', '=', $id)->first();
//        dump($user);
//        dd($org);
        if ($org == null) {
            $user->status = 'reported';
            if ($user->save()) {
                return redirect()->back()->with('message', 'User account status changed to reported')->with('type',
                                                                                                            'success');
            }
        }
        if (\Config::get('settings.environment') == 'production') {
            $users = User::where('org_id', '=', $org->id)->get();
            $emails = [];
            foreach ($users as $user) {
                $emails[] = $user->email;
            }
            $data = array(
                'org_name'  => $org->name,
                'org_admin' => $org->admin_name
            );
            Mail::queue('emails/org_admin_deleted', $data, function ($message) use ($emails) {
                $message
                    ->to($emails)->cc('info@pakblood.com')
                    ->replyTo('info@pakblood.com')
                    ->subject('Organization Admin');
            });
        }
//        $org->user_id = 0;
//        $org->username = '';
//        $org->admin_name = '';
//        $org->email = '';
        $org->status = 'inacitve';
        $org->save();
//        $user->delete();
        $user->status = 'reported';
//        $user->is_deleted = 1;
        $user->save();
        return redirect()->back()->with('message',
                                        'User account status changed to reported, and organization to inactive')->with('type',
                                                                                                                       'success');
    }

    function deleteReport($id)
    {
        $report = Report::find($id);
        $user = User::find($report->reported_user_id);
        if ($report->delete()) {
            $reports = Report::where('reported_user_id', $user->id)->count();
            $user->status = ($reports >= 3) ? "reported" : "active";
            $user->save();
            return redirect()->back()->with('message', 'Report Successfully deleted.')->with('type', 'success');
        }
        return redirect()->back()->with('message', 'There was some problem with deleting user report.')->with('type',
                                                                                                              'error');
    }
}
