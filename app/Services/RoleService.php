<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleService
{
    public function getList(array $filter = [])
    {
        $role = new Role;
        $roleTable = $role->getTable();
        $query = $role
            ->select("{$roleTable}.*")
            ->search($filter, ['roles.name']);
        
        return $query->paginate(10)->withQueryString();
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $role = Role::create($data);
            $role->permissions()->sync(Arr::get($data, 'permission', []));

            DB::commit();

            return $role;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, Role $role)
    {
        DB::beginTransaction();
        try {
            $role->fill($data)->save();
            $role->permissions()->sync(Arr::get($data, 'permission', []));

            DB::commit();

            return $role;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }        
    }

    public function delete(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
    }
}
