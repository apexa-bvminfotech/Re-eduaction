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
        Schema::create('sub_course_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_course_id')->constrained('sub_courses')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('sub_course_points');
    }
};
