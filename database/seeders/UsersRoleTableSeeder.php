<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role; 
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UsersRoleTableSeeder extends Seeder
{
    public function run()
    { 
        $whereNotInRoles = array(1,2,4,5,6,7,8,9);

        $user = User::create(['username' => 'Saifah.P', 'email' => 'Saifah.P@gmail.com', 'password' => bcrypt('phaiwan8953')]);
        $role = Role::create(['name' => 'Booking Meeting Room', 'guard_name' => 'web']); 
        $permissions = Permission::whereNotIn('id', $whereNotInRoles)->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]); 
    }
}