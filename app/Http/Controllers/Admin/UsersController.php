<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Pegawai;
use Session;

class UsersController extends Controller
{
    public function index()
    {
        $users = Pegawai::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'           => 'required',
            'email'          => 'required',
            'OPD'       => 'required',
            'jabatan'       => 'required',
        
            ]);

        $user = new Pegawai;

        $user->nama      = $request->nama;
        $user->email     = $request->email;
        $user->OPD  = $request->OPD;

        $user->jabatan  = $request->jabatan;
        if($user->save())
        {
            $alert_toast = 
            [
                'title' => 'Operation Successful : ',
                'text'  => 'Data Successfully Added.',
                'type'  => 'success',
            ];
            
        }
        else
        {
            $alert_toast = 
            [
                'title' => 'Operation Failed : ',
                'text'  => 'A Problem Occurred While Adding a Data.',
                'type'  => 'danger',
            ];
        }

        Session::flash('alert_toast', $alert_toast);
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        
        $user = Pegawai::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'           => 'required',
            'email'          => 'required',
            'OPD'       => 'required',
            'jabatan'       => 'required',
        ]);

        $user = Pegawai::findOrFail($id);

        $user->nama      = $request->nama;
        $user->email     = $request->email;
        $user->OPD  = $request->OPD;

        $user->jabatan  = $request->jabatan;

        if($user->save())
        {
            $alert_toast = 
            [
                'title' => 'Operation Successful : ',
                'text'  => 'Data Successfully Updated.',
                'type'  => 'success',
            ];
        }
        else
        {
            $alert_toast = 
            [
                'title' => 'Operation Failed : ',
                'text'  => 'A Problem Update The Data.',
                'type'  => 'danger',
            ];
        }

        Session::flash('alert_toast', $alert_toast);
        return redirect()->route('admin.users.index');
    }

    public function delete(Request $request)
    {
        $user = Pegawai::findOrFail($request->id);
        if($user->delete())
        {
            $alert_toast = 
            [
                'title' =>  'Operation Successful : ',
                'text'  =>  'Data Successfully Deleted.',
                'type'  =>  'success',
            ];
        }
        else
        {
            $alert_toast = 
            [
                'title' => 'Operation Failed : ',
                'text'  => 'A Problem Deleting The Data.',
                'type'  => 'danger',
            ];
        }

        Session::flash('alert_toast', $alert_toast);
        return redirect()->route('admin.users.index');
    }

 
}
