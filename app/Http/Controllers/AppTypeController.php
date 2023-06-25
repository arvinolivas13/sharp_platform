<?php

namespace App\Http\Controllers;

use App\AppType;
use Illuminate\Http\Request;
use Auth;

class AppTypeController extends Controller
{   
    public function get() {
        if(request()->ajax()) {
            return datatables()->of(AppType::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:app_types',
            'sort_no' => 'required',
        ]);

        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        AppType::create($request->all());

        return response()->json(compact('validate'));
    }
    
    public function edit($id)
    {
        $appType = AppType::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('appType'));
    }

    public function update(Request $request, $id)
    {
        $request['updated_by'] = Auth::user()->id;
        AppType::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            AppType::find($item)->delete();
        }
        
        return 'Record Deleted';
    }

    public function get_list($id) {
        $data = null;

        if($id === "all") {
            $data = AppType::where('status', 1)->get();
        }
        else {
            $data = AppType::where('id', $id)->where('status', 1)->get();
        }
        
        return response()->json(compact('data'));
    }
}
