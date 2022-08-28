<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;

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

    public function index(UserService $userService, Request $request)
    {
        $this->authorize('can_do', ['user read']);
        $filter = $request->query();
        $users = $userService->getList($filter);
        return view('admin.user.index', compact('users'));
    }

    public function create(Role $role, User $user)
    {
        $this->authorize('can_do', ['user create']);
        $user->all();
        $roles = $role->all();
        return view('admin.user.create-user', ['roles' => $roles]);
    }

    public function store(StoreUserRequest $request, UserService $userService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $user = $userService->create($request->validated());
        if(is_null($user))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/user')
            ->with('success', 'Successfully created.');
    }

    public function edit(User $user, Role $role)
    {
        $this->authorize('can_do', ['user edit']);
        $users = $user->find($user->id);
        $roles = $role->all();
        $dataRoles = $users->roles->pluck('id')->toArray();
        return view('admin.user.edit-user',['users' => $users, 'roles' => $roles, 'dataRoles' => $dataRoles]);
    }    

    public function update(UpdateUserRequest $request, UserService $userService, User $user)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $userService->update($request->validated(), $user);     

        return redirect('/user')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(User $user, UserService $userService)
    {
        $userService->delete($user);
        return redirect('/user')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
