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
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['medium']);
            $table->string('email_id')->nullable()->change();
            $table->dateTime('dob')->nullable()->change();
            $table->integer('age')->nullable()->change();
            $table->string('payment_condition')->nullable()->change();
            $table->integer('demo_trainer_id')->default(0)->nullable()->change();
            $table->integer('analysis_trainer_id')->default(0)->nullable()->change();
            $table->string('upload_analysis')->nullable()->change();
            $table->string('upload_student_image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('email_id')->nullable(false)->change();
            $table->enum('medium',['gujarati','hindi','english'])->after('standard');
            $table->dateTime('dob')->nullable(false)->change();
            $table->integer('age')->nullable(false)->change();
            $table->string('payment_condition')->nullable(false)->change();
            $table->integer('demo_trainer_id')->default(0)->nullable(false)->change();
            $table->integer('analysis_trainer_id')->default(0)->nullable(false)->change();
            $table->string('upload_analysis')->nullable(false)->change();
            $table->string('upload_student_image')->nullable(false)->change();
        });
    }
};
