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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staff_name');
            $table->string('password');
            $table->string('staff_phone');
            $table->string('course_id');
            $table->string('employee_ID');
            $table->string('staff_I-card');
            $table->string('staff_uniform');
            $table->string('staff_email');
            $table->string('staff_address');
            $table->string('eme_phone')->comment('Emergency contact no');
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
        Schema::dropIfExists('staff');
    }
};
