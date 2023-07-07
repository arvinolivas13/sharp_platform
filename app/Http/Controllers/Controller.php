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
use App\Access;
use App\App;
use App\AppModule;

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

    public function log_get() {
        if(request()->ajax()) {
            return datatables()->of(ActivityLogs::with('user')->orderBy('created_at', 'desc')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function getPermissionAccess(Request $request) {
        $role = Auth::user()->access->role_id;
        
        if($request->project_type === "apps") {
            $project_id = App::where('code', $request->project_code)->first()->id;
        }
        else if($request->project_type === "app_module") {
            $project_id = AppModule::where('code', $request->project_code)->first()->id;
        }

        $access = Access::where('role_id', $role)->where('permission_for', $request->project_type)->where('permission_for_id', $project_id)->firstOrFail();

        return response()->json(compact('access', 'project_id'));
    }

}
