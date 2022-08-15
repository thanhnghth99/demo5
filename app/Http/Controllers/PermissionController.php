<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(Permission $permissions)
    {
        $permissions = $permissions->latest()->paginate(5);
        return view('admin.permission.permission', compact('permissions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(Permission $permission)
    {
        $permissions = $permission->all();
        return view('admin.permission.create-permission', ['permissions' => $permissions]);
    }

    public function store(Request $request, Permission $permission)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $permission->create($data);
        return redirect('/permission');
    }

    public function edit(Permission $permission)
    {
        $permissions = $permission->find($permission->id);
        return view('admin.permission.edit-permission',['permissions' => $permissions]);
    }    

    public function update(Request $request, Permission $permission)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $permissions = $permission->find($permission->id);
        $permissions->fill($data)->save();
        return redirect('/permission');
    }

    public function destroy(Permission $permission)
    {
        $permissions = $permission->delete();
        return redirect('/permission');
    } 
    
    public function show()
    {

    }
}
