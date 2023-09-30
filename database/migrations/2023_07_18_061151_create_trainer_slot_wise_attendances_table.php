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
        Schema::create('trainer_slot_wise_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainer_attendance_id');
            $table->unsignedBigInteger('slot_id');
            $table->boolean('status');
            $table->string('absent_reason')->nullable();
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
        Schema::dropIfExists('trainer_slot_wise_attendances');
    }
};
