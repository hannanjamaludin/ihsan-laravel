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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 200);
            $table->string('ic_no', 50);
            $table->Date('dob');
            $table->string('gender', 20);
            $table->string('siblings', 20)->comment('the position of the student among the siblings');
            $table->string('illness', 100)->nullable();
            $table->string('allergy', 100)->nullable();
            $table->string('study', 100)->nullable();
            $table->string('disability', 100)->nullable();
            $table->string('address1', 100);
            $table->string('postcode', 100);
            $table->string('district', 100);
            $table->string('state', 100);
            $table->integer('branch_id');
            $table->integer('dad_id');
            $table->integer('mom_id');
            $table->boolean('is_active');
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
        Schema::dropIfExists('students');
    }
};
