<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // function __construct(User $user)
    // {   
    //     $this->middleware('can:user read', ['only' => ['index', 'show']]);
    //     $this->middleware('can:user create', ['only' => ['create', 'store']]);
    //     $this->middleware('can:user edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('can:user delete', ['only' => ['destroy']]);
    // }

    public function index(User $users)
    {
        $this->authorize('can_do', ['user read']);
        $users = $users->latest()->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create(Role $role, User $user)
    {
        $this->authorize('can_do', ['user create']);
        $users = $user->all();
        $roles = $role->all();
        return view('admin.user.create-user', ['users' => $users, 'roles' => $roles]);
    }

    public function store(Request $request, User $user)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
            'status' => 'required',
            'role' => 'nullable|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'role' => $request->role,
        ]);

        $user->roles()->sync($data['role']);

        return redirect('/user')
            ->with('success', 'Successfully created');
    }

    public function edit(User $user, Role $role)
    {
        $this->authorize('can_do', ['user edit']);
        $users = $user->find($user->id);
        $roles = $role->all();
        $dataRoles = $users->roles()->get();
        return view('admin.user.edit-user',['users' => $users, 'roles' => $roles, 'dataRoles' => $dataRoles]);
    }    

    public function update(Request $request, User $user)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'role' => 'nullable|array'
        ]);
        
        $user->fill($data)->save();
        $user->roles()->sync($data['role']);

        return redirect('/user');
    }

    public function destroy(User $user)
    {
        $this->authorize('can_do', ['user delete']);
        $user->delete();
        return redirect('/user');
    } 
    
    public function show()
    {

    }
}
