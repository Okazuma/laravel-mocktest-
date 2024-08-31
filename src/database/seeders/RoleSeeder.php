<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        
        // パーミッションの作成
        $manageUsersPermission = Permission::create(['name' => 'manage users']);

        // ロールにパーミッションを付与
        $adminRole->givePermissionTo($manageUsersPermission);
    }
}
