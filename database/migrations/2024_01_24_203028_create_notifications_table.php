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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id')->comment('รหัสผู้ส่ง')->nullable();
            $table->integer('recipient_id')->comment('รหัสผู้รับ')->default(0)->nullable();
            $table->integer('type_id')->comment('รหัสผู้รับ')->nullable();
            $table->string('url')->nullable();
            $table->string('message')->comment('ข้อความการแจ้งเตือน')->nullable();
            $table->char('status')->default('N')->comment('สถานะการเปิดดู'); 
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
        Schema::dropIfExists('notifications');
    }
};
