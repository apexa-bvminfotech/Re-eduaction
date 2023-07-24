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
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('trainer_id')->nullable()->constrained('trainers');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('course_id')->constrained('courses')->nullable();
            $table->foreignId('sub_course_id')->constrained('sub_courses')->nullable();
            $table->foreignId('sub_course_point_id')->constrained('sub_course_points')->nullable();
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
