<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{ 
    public function run()
    { 
        $permissions = [
            ["group" => "user", "name" => "user-list", "description" => "หน้ารายการผู้ใช้งาน"],
            ["group" => "user", "name" => "user-create", "description" => "หน้าการสร้างผู้ใช้งาน"],
            ["group" => "user", "name" => "user-edit", "description" => "หน้าการแก้ไขผู้ใช้งาน"],
            ["group" => "user", "name" => "user-delete", "description" => "สำหรับลบผู้ใช้งาน"],
            ["group" => "user", "name" => "user-set-roles", "description" => "สำหรัผู้ใช้งานที่สามารถกำหนด Role ได้"],
              
            ["group" => "role", "name" => "role-list", "description" => "หน้ารายการสิทธ์การใช้งาน"],
            ["group" => "role", "name" => "role-create", "description" => "หน้าการสร้างสิทธ์การใช้งาน"],
            ["group" => "role", "name" => "role-edit", "description" => "หน้าแก้ไขสิทธ์การใช้งาน"],
            ["group" => "role", "name" => "role-delete", "description" => "สำหรับลบสิทธ์การใช้งาน"], 

            ["group" => "meeting-rooms", "name" => "meeting-rooms-list", "description" => "หน้ารายการห้องประชุม"],
            ["group" => "meeting-rooms", "name" => "meeting-rooms-create", "description" => "หน้าการสร้างห้องประชุม"],
            ["group" => "meeting-rooms", "name" => "meeting-rooms-edit", "description" => "หน้าการแก้ไขห้องประชุม"],
            ["group" => "meeting-rooms", "name" => "meeting-rooms-delete", "description" => "สำหรับลบห้องประชุม"], 

            ["group" => "meetings", "name" => "meetings-list", "description"   => "หน้ารายการการประชุม"],
            ["group" => "meetings", "name" => "meetings-create", "description" => "หน้าการสร้างการประชุม"],
            ["group" => "meetings", "name" => "meetings-edit", "description"   => "หน้าการแก้ไขการประชุม"],
            ["group" => "meetings", "name" => "meetings-delete", "description" => "สำหรับลบการประชุม"], 
 
        ];
 
        foreach ($permissions as $row) {
            Permission::create(["group"=> $row['group'], "name" => $row['name'], "description" => $row['description'], "guard_name" => "web"]);
        }
    }
}