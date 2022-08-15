<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class roleController extends Controller
{
    public function index(Role $roles)
    {
        $roles = $roles->latest()->paginate(5);
        return view('admin.role.role', compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(Permission $permission, Role $role)
    {
        $roles = $role->all();
        $permissions = $permission->all();
        return view('admin.role.create-role', ['permissions' => $permissions]);
    }

    public function store(Request $request, Role $role)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'permission' => 'nullable|array',
        ]);

        $dataAdd = $role->create($data);
        $dataAdd->tags()->sync($data['permission']);
        return redirect('/role');
    }

    public function edit(Role $role)
    {
        $roles = $role->find($role->id);
        return view('admin.role.edit-role',['roles' => $roles]);
    }    

    public function update(Request $request, Role $role)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'permission' => 'nullable|array',
        ]);

        $roles = $role->find($role->id);
        $roles->fill($data)->save();
        return redirect('/role');
    }

    public function destroy(Role $role)
    {
        $roles = $role->delete();
        return redirect('/role');
    } 
    
    public function show()
    {

    }
}
