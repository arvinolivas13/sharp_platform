<?php

namespace App\Http\Controllers;

use App\AppModule;
use Illuminate\Http\Request;
use Auth;

class AppModuleController extends Controller
{
    public function get() {
        if(request()->ajax()) {
            return datatables()->of(AppModule::with('app')->get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:app_modules',
            'app_id' => 'required',
            'sort_no' => 'required',
        ]);

        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        AppModule::create($request->all());

        return response()->json(compact('validate'));
    }
    
    public function edit($id)
    {
        $appModule = AppModule::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('appModule'));
    }

    public function update(Request $request, $id)
    {
        $request['updated_by'] = Auth::user()->id;
        AppModule::find($id)->update($request->all());
        return "Record Saved";
    }

    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            AppModule::find($item)->delete();
        }
        
        return 'Record Deleted';
    }

    public function get_list($id) {
        $data = null;

        if($id === "all") {
            $data = AppModule::where('status', 1)->get();
        }
        else {
            $data = AppModule::where('id', $id)->where('status', 1)->get();
        }
        
        return response()->json(compact('data'));
    }
}
