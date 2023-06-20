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
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->string('slot_time');
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->unsignedBigInteger('rtc_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('whatsapp_group_name')->nullable();
            $table->boolean('is_active')->default(0);
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('rtc_id')->references('id')->on('rtc')->onDelete('cascade');
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
        Schema::dropIfExists('slots');
    }
};
