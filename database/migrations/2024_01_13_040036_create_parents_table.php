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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name', 200);
            $table->string('ic_no', 50);
            $table->string('phone_no', 50);
            $table->integer('role_id')->comment('1:UTM staff', '2:UTM student', '3:Outsider');
            $table->string('staff_no', 30)->nullable(); 
            $table->string('student_no', 30)->nullable(); 
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents');
    }
};
