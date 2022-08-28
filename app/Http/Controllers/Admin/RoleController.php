<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Services\RoleService;

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

    public function index(RoleService $roleService, Request $request)
    {
        $this->authorize('can_do', ['role read']);
        $filter = $request->query();
        $roles = $roleService->getList($filter);
        return view('admin.role.index', compact('roles'));
    }

    public function create(Permission $permission, Role $role)
    {
        $this->authorize('can_do', ['role create']);
        $role->all();
        $permissions = $permission->all();
        return view('admin.role.create-role', ['permissions' => $permissions]);
    }

    public function store(StoreRoleRequest $request, RoleService $roleService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $role = $roleService->create($request->validated());
        if(is_null($role))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/role')
            ->with('success', 'Successfully created.');
    }

    public function edit(Role $role, Permission $permission)
    {
        $this->authorize('can_do', ['role edit']);
        $roles = $role->find($role->id);
        $permissions = $permission->all();
        $dataPermissions = $roles->permissions->pluck('id')->toArray();

        return view('admin.role.edit-role',['roles' => $roles, 'permissions' => $permissions, 'dataPermissions' => $dataPermissions]);
    }    

    public function update(UpdateRoleRequest $request, Role $role, RoleService $roleService)
    {
        date_default_timezone_set('asia/ho_chi_minh');

        $roleService->update($request->validated(), $role);
        
        return redirect('/role')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Role $role, RoleService $roleService)
    {
        $this->authorize('can_do', ['role delete']);
        $roleService->delete($role);
        return redirect('/role')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
