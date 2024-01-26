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
        Schema::create('meeting_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('ชื่อห้องประชุม');
            $table->string('description')->nullable()->comment('คำอธิบายห้องประชุม'); 
            $table->string('color')->nullable()->comment('สีห้องประชุม');
            $table->char('status')->default(1)->comment('0 = Disable, 1 = Enable'); 
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
        Schema::dropIfExists('meeting_rooms');
    }
};
