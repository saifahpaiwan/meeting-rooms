<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        $role = Role::create(['name' => 'Super Admin']);
        $permissions = Permission::all();
        $user = User::create(['username' => 'Saifah.P', 'email' => 'saifah1928@gmail.com', 'password' => bcrypt('phaiwan8953')]);
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
