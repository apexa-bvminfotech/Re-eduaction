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
        Schema::create('sub_course_point', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_course_id')->nullable();
            $table->foreign('sub_course_id')->references('id')->on('sub_course')->onDelete('cascade');
            $table->string('sub_point_name');
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
        Schema::dropIfExists('sub_course_point');
    }
};
