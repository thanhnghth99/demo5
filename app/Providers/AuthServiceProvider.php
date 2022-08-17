<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::before(function($user, $ability) {
            if ($user->usertype) {
                return true;
            }
        });

        foreach(Permission::all() as $permission)
        {
            Gate::define($permission->name, function($user) use ($permission)
            {
                return $user->hasPermission($permission);
            });
        }

        Gate::define('can_do', function(User $user, $permissionName)
        {
            return $user->hasPermission($permissionName);
        });
    }
}
