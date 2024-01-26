<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  
            $table->integer('plant_id')->nullable()->comment("รหัสโรงงานของบริษัท")->index();
            $table->string('username')->nullable()->comment("ชื่อผู้ใช้งานระบบ");
            $table->string('email')->unique()->comment("อีเมลผู้ใช้งานระบบ");
            $table->timestamp('email_verified_at')->nullable()->comment("Verified Email เพื่อยืนยันตัวตน"); 
            $table->string('phone')->nullable()->comment("เบอร์โทรติดต่อ"); 
            $table->string('password');
            $table->string('images_name')->nullable()->comment("รูปประจำตัวผู้ใช้งาน"); 
            $table->char('receive_notifications_email')->default('Y')->comment("สถานะเพื่อรับการแจ้งเตือน");
            $table->char('receive_notifications_system')->default('Y')->comment("สถานะเพื่อรับการแจ้งเตือน");
            $table->string('empolyee_code')->nullable()->comment("รหัสพนักงาน"); 
            $table->rememberToken();
            $table->char('status')->default(1)->comment("สถานะการแสดผล : 0=Disable, 1=Enable"); 
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
