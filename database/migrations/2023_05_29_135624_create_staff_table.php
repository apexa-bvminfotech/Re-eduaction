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
            $table->string('first_name');
            $table->string('staff_name');
            $table->string('father_name');
            $table->string('staff_phone');
            $table->string('course_id');
            $table->string('employee_ID');
            $table->boolean('staff_I_card')->default(0);
            $table->boolean('staff_uniform')->default(0);
            $table->string('staff_address');
            $table->string('eme_phone')->comment('Emergency contact no');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
