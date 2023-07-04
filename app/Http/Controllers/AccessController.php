<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;
use App\Access;

class AccessController extends Controller
{
    public function get_apps($id) {
        if(request()->ajax()) {
            return datatables()->of(App::with('app_modules')->where('app_type_id', $id)->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function get_access($role_id) {
        $data = Access::where('role_id', $role_id)->get();
        
        return response()->json(compact('data'));
    }
}
