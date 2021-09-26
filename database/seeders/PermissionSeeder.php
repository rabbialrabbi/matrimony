<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role permissions
        Permission::create(['name' => 'Access Role', 'slug' => 'access-role', 'for' => 'role']);
        Permission::create(['name' => 'Create Role', 'slug' => 'create-role', 'for' => 'role']);
        Permission::create(['name' => 'Update Role', 'slug' => 'update-role', 'for' => 'role']);
        Permission::create(['name' => 'Show Role', 'slug' => 'show-role', 'for' => 'role']);
        Permission::create(['name' => 'Delete Role', 'slug' => 'delete-role', 'for' => 'role']);

        // User Permission
        Permission::create(['name' => 'Access User', 'slug' => 'access-user', 'for' => 'user']);
        Permission::create(['name' => 'Create User', 'slug' => 'create-user', 'for' => 'user']);
        Permission::create(['name' => 'Update User', 'slug' => 'update-user', 'for' => 'user']);
        Permission::create(['name' => 'Show User', 'slug' => 'show-user', 'for' => 'user']);
        Permission::create(['name' => 'Delete User', 'slug' => 'delete-user', 'for' => 'user']);
    }
}
