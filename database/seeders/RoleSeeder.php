<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin', 'slug' => 'super-admin', 'description' => 'All permission access']);
        Role::create(['name' => 'Sub Admin', 'slug' => 'sub-admin', 'description' => 'Only can view and edit']);

        /* Assign role permissions to admin */
        $permissions = Permission::all();

        $roleSuperAdmin = Role::where('slug', 'super-admin')->first();
        $user = User::find(1);
        $user->roles()->sync($roleSuperAdmin->id);
        foreach ($permissions as $permission){
            $roleSuperAdmin->givePermissionTo($permission);
        }
    }
}
