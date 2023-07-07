<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App;
use Auth;
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

    public function store(Request $request) {
        $data = $request->data;

        foreach($data as $item) {
            $record = Access::where('role_id', $item['role_id'])->where('permission_for', $item['permission_for'])->where('permission_for_id', $item['permission_for_id'])->count();
            if($record === 0) {
                
                $item['created_by'] = Auth::user()->id;
                $item['updated_by'] = Auth::user()->id;
                
                Access::create($item);
            }
            else {
                $item['updated_by'] = Auth::user()->id;
                Access::where('role_id', $item['role_id'])->where('permission_for', $item['permission_for'])->where('permission_for_id', $item['permission_for_id'])->update($item);
            }
        }
        
    }
}
