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
            $table->integer('key_point')->default(0)->after('counselling_by');
            $table->date('key_point_date')->nullable();
            $table->integer('counselling_by_trainer')->default(0);
            $table->date('counselling_by_trainer_name')->nullable();
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
