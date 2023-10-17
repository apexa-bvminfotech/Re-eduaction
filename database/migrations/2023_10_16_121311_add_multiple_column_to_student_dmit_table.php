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
        Schema::table('student_dmit', function (Blueprint $table) {
            $table->text('stf_gujarati')->nullable();
            $table->text('stf_hindi')->nullable();
            $table->text('stf_english')->nullable();
            $table->text('stf_maths')->nullable();
            $table->text('stf_self_development')->nullable();
            $table->text('stf_others')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_dmit', function (Blueprint $table) {
            //
        });
    }
};
