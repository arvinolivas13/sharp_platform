<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use Auth;
use App\ActivityLogs;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index($app_type, $app, $module) {
        return view('backend.pages.project.'.$app_type.'.'.$app.'.'.$module);
    }

    public function direct_app($app_type, $app) {
        return view('backend.pages.project.'.$app_type.'.'.$app);
    }

    public function set_log($action, $details, $ip) {
        $data = array(
            "action" => $action,
            "details" => $details,
            "ip_address" => $ip,
            "device_info" => Agent::browser(),
            "created_by" => Auth::user()->id,
            "updated_by" => Auth::user()->id
        );

        Activitylogs::create($data);

        return "Logs Added";
    }

    public function log_get($date) {
        if(request()->ajax()) {
            return datatables()->of(ActivityLogs::where('created_at', '>=', $date.' 00:01')->where('created_at', '<=', $date.' 23:59')->orderBy('created_at', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

}
