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
        Schema::create('student_course_completes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('trainer_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('sub_course_id');
            $table->unsignedBigInteger('sub_course_point_id');
            $table->boolean('before')->default(0);
            $table->boolean('after')->default(0);
            $table->integer('status')->default(0)->comment('0=default,1=Trainer-Confirm,2=Admin-Confirm');
            $table->date('trainer_confirm_date');
            $table->date('admin_confirm_date');
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
        Schema::dropIfExists('student_course_completes');
    }
};
