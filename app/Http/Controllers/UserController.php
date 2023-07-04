<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function get() {
        if(request()->ajax()) {
            return datatables()->of(User::get())
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        $department = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required'],
            'status' => ['required'],
        ]);

        $request->request->add([
            'workstation_id' => Auth::user()->workstation_id, 
            'created_by' => Auth::user()->id, 
            'updated_by' => Auth::user()->id, 
            'password' => Hash::make('P@ssw0rd')
        ]);

        User::create($request->all());

        return redirect()->back()->with('success','Successfully Added');
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->orderBy('id')->firstOrFail();
        return response()->json(compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request['status'] = isset($request['status'])?1:0;
        User::find($id)->update($request->all());
        return response()->json(['Successfully Updated']);
    }
    
    
    public function destroy(Request $request)
    {
        $record = $request->data;

        foreach($record as $item) {
            User::find($item)->delete();
        }
        
        return 'Record Deleted';
    }

}
