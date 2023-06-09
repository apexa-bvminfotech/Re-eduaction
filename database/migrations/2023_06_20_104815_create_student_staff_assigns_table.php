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
        Schema::create('student_staff_assigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('trainers_id')->constrained('trainers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('slots_id')->constrained('slots')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date');
            $table->integer('is_active')->default(0);
            $table->string('type');
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
        Schema::dropIfExists('student_staff_assigns');
    }
};
