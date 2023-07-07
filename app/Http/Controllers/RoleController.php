<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Auth;

class RoleController extends Controller
{
    public function get() {
        if(request()->ajax()) {
            return datatables()->of(Role::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        Role::create($request->all());

        return response()->json(compact('validate'));
    }
    
    public function edit($id)
    {
        $app = Role::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('app'));
    }

    public function update(Request $request, $id)
    {
        $request['updated_by'] = Auth::user()->id;
        Role::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            Role::find($item)->delete();
        }
        
        return 'Record Deleted';
    }
    
    public function get_list($id) {
        $data = null;

        if($id === "all") {
            $data = Role::get();
        }
        else {
            $data = Role::where('id', $id)->get();
        }
        
        return response()->json(compact('data'));
    }
}
