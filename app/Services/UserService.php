<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function getList(array $filter = [])
    {
        $user = new User;
        $userTable = $user->getTable();
        $query = $user
            ->select("{$userTable}.*")
            ->search($filter, ['users.name']);
        
        return $query->paginate(10)->withQueryString();
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            
            $user = User::create($data);
            $user->roles()->sync(Arr::get($data, 'role', []));

            DB::commit();

            return $user;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, User $user)
    {
        DB::beginTransaction();
        try {
            $user->fill($data)->save();
            $user->roles()->sync(Arr::get($data, 'role', []));

            DB::commit();

            return $user;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }        
    }

    public function delete(User $user)
    {
        $user->roles()->detach();
        $user->delete();
    }
}
