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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('meeting_rooms_id')->nullable()->comment('รหัสห้องประชุม')->index();
            $table->integer('booker_id')->nullable()->comment('รหัสผู้ทำการจอง')->index();
            $table->string('title')->nullable()->comment('หัวข้อการประชุม');
            $table->string('description')->nullable()->comment('คำอธิบายการประชุม');  
            $table->json('send_to')->nullable()->comment('ผู้เข้าร่วมการประชุม Arrary'); 
            $table->dateTime('start_time')->nullable()->comment('เริ่มวันที่ประชุม');
            $table->dateTime('end_time')->nullable()->comment('สิ้นสุดวันที่ประชุม'); 
            $table->char('status')->default(1)->comment('0 = Disable, 1 = Enable'); 
            $table->char('approved')->default("N")->comment('N = ยังไม่อนุมัติ, Y = อนุมัติสำเร็จ'); 
            $table->char('allday')->default("N")->comment('N = ไม่เลือกทุกวัน, Y = เลือกทุกวัน'); 
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
        Schema::dropIfExists('meetings');
    }
};
