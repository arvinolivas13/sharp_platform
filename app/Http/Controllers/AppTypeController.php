<?php

namespace App\Http\Controllers;

use App\AppType;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;

class AppTypeController extends Controller
{   
    protected $func;

    public function __construct() {
        $this->setup = new Controller();
    }

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
            'code' => 'required|unique:app_types,deleted_at,NULL',
            'sort_no' => 'required',
        ]);

        $request['workstation_id'] = Auth::user()->workstation_id;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        AppType::create($request->all());
        $this->setup->set_log('App Type Added', '"'.$request->name.'" was added at App Type Records.', $request->ip());

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
