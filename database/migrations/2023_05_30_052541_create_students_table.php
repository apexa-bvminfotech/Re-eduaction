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
            $table->string('form_no');
            $table->string('surname');
            $table->string('name');
            $table->string('father_name');
            $table->longText('address');
            $table->enum('gender',['male','female']);
            $table->string('email_id');
            $table->string('father_contact_no')->nullable();
            $table->string('mother_contact_no')->nullable();
            $table->integer('standard');
            $table->enum('medium',['gujarati','hindi','english']);
            $table->string('school_name');
            $table->string('school_time')->nullable();
            $table->string('extra_tuition_time')->nullable();
            $table->dateTime('dob');
            $table->integer('age');
            $table->foreignId('course_id')->constrained('courses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('payment_condition');
            $table->string('reference_by')->nullable();
            $table->foreignId('demo_staff_id')->constrained('staff')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('fees',['paid','unpaid'])->nullable();
            $table->time('batch_time')->nullable();
            $table->string('extra_note')->nullable();
            $table->foreignId('analysis_staff_id')->constrained('staff')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('upload_analysis')->nullable();
            $table->string('upload_student_image');
            $table->boolean('status')->default(1);
            $table->foreignId('user_id')->constrained('users');
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
