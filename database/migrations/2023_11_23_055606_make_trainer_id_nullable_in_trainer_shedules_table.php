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
        Schema::table('trainer_shedules', function (Blueprint $table) {
            $table->unsignedBigInteger('trainer_id')->nullable()->change();
            $table->unsignedBigInteger('slot_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainer_shedules', function (Blueprint $table) {
            $table->unsignedBigInteger('trainer_id')->change();
        $table->unsignedBigInteger('slot_id')->change();
        });
    }
};
