<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // function __construct()
    // {
    //     $this->middleware('can:permission read', ['only' => ['index', 'show']]);
    //     $this->middleware('can:permission create', ['only' => ['create', 'store']]);
    // }

    public function index(Permission $permissions)
    {
        $this->authorize('can_do', ['permission read']);
        $permissions = $permissions->paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    public function create(Permission $permission)
    {
        $this->authorize('can_do', ['permission create']);
        $permission->all();
        return view('admin.permission.create-permission');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Permission::create($data);
        return redirect('/permission')
            ->with('success', 'Successfully created.');
    }

    public function show()
    {

    }
}
