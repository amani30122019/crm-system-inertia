<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class PermissionAdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'post list',
            'post create',
            'post edit',
            'post delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        $standard_user = Role::create(['name' => 'standard_user']);
        $standard_user->givePermissionTo('post list');
        $standard_user->givePermissionTo('post create');
        $standard_user->givePermissionTo('post edit');
        $standard_user->givePermissionTo('post delete');

        $admin_user = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $admin_user->givePermissionTo($permission);
        }

        $super_admin_user = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@ikotek.net',
        ]);
        $user->assignRole($super_admin_user);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@ikotek.net',
        ]);
        $user->assignRole($admin_user);

        $user = User::factory()->create([
            'name' => 'Standard User',
            'email' => 'standarduser@ikotek.net',
        ]);
        $user->assignRole($standard_user);
    }
}