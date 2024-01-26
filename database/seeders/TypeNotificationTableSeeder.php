<?php
namespace Database\Seeders;
  
use App\Models\type_notifications; 
use Illuminate\Database\Seeder;

class TypeNotificationTableSeeder extends Seeder
{  
    public function run()
    { 
        $status = [  
            ["name" => "แจ้งเตือน", "color" => "warning", "icon" => "mdi mdi-bell-outline"],  
        ];
        
        foreach ($status as $row) {
            type_notifications::create(["name"=> $row['name'], "color"=> $row['color'], "icon"=> $row['icon']]);
        }
    }
}

 	 
 	 