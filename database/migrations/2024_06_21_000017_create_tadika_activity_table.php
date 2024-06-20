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
        Schema::create('tadika_activity', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('teacher_id');
            $table->integer('subject_id');
            $table->string('learning');
            $table->string('activity');
            $table->Date('date');
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
        Schema::dropIfExists('tadika_activity');
    }
};
