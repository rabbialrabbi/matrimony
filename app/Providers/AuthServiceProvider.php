<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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
//        $auth = [];

        foreach ($this->getPermissions() as $permission) {
            Gate::define(strtolower($permission->slug), function ($user) use ($permission) {
                return $user->hasRole($permission->roles);

            });
        }

        //
    }

    /**
     * Get all permissions with role.
     *
     * @return array
     */
    protected function getPermissions()
    {
        if (Schema::hasTable('roles') && Schema::hasTable('permissions')) {
            return Permission::with('roles')->get();
        } else {
            return [];
        }
    }
}
