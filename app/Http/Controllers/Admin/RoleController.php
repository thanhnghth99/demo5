<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class roleController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // function __construct()
    // {
    //     $this->middleware('can:role read', ['only' => ['index', 'show']]);
    //     $this->middleware('can:role create', ['only' => ['create', 'store']]);
    //     $this->middleware('can:role edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('can:role delete', ['only' => ['destroy']]);
    // }

    public function index(Role $roles)
    {
        $this->authorize('can_do', ['role read']);
        $roles = $roles->latest()->paginate(5);
        return view('admin.role.index', compact('roles'));
    }

    public function create(Permission $permission, Role $role)
    {
        $this->authorize('can_do', ['role create']);
        $role->all();
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

        $role = Role::create($data);
        $role->permissions()->sync($data['permission']);
        return redirect('/role')
            ->with('success', 'Successfully created.');
    }

    public function edit(Role $role, Permission $permission)
    {
        $this->authorize('can_do', ['role edit']);
        $roles = $role->find($role->id);
        $permissions = $permission->all();
        $dataPermissions = $roles->permissions()->get();

        return view('admin.role.edit-role',['roles' => $roles, 'permissions' => $permissions, 'dataPermissions' => $dataPermissions]);
    }    

    public function update(Request $request, Role $role)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'permission' => 'nullable|array',
        ]);

        $role->fill($data)->save();
        $role->permissions()->sync($data['permission']);
        
        return redirect('/role')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('can_do', ['role delete']);
        $role->delete();
        return redirect('/role')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
