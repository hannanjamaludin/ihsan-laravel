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
        Schema::create('taska_activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('teacher_id');
            $table->string('activity');
            $table->date('date');
            $table->tinyInteger('type')->comment('1: image, 2: video');
            $table->string('path', 255);
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('class')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('staffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taska_activity');
    }
};
