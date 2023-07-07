<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleSetup;
use Auth;

class RoleSetupController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'role_id' => 'required'
        ]);

        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        if(RoleSetup::where('user_id', $request->user_id)->count() !== 0) {
            RoleSetup::where('user_id', $request->user_id)->update($request->except('_token'));
        }
        else {
            RoleSetup::create($request->except('_token'));
        }

        return response()->json(compact('validate'));
    }

    public function get_list($id) {
        $data = null;

        if($id === "all") {
            $data = RoleSetup::firstOrFail();
        }
        else {
            if(RoleSetup::where('id', $id)->count() !== 0){
                $data = RoleSetup::where('id', $id)->firstOrFail();
            }
            else {
                $data = null;
            }
        }
        
        return response()->json(compact('data'));
    }
}
