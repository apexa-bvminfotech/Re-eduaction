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
        Schema::create('rtc', function (Blueprint $table) {
            $table->id();
            $table->string('rtc_name');
            $table->foreignId('branch_id');
            $table->string('person_name');
            $table->string('contact');
            $table->text('address');
            $table->string('rtc_no');
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
        Schema::dropIfExists('rtc');
    }
};
