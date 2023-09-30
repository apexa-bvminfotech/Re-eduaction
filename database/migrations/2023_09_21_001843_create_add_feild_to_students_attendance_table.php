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
        Schema::table('students_attendance', function (Blueprint $table) {
                $table->unsignedBigInteger('trainer_id');
                $table->unsignedBigInteger('slot_id');
                $table->enum('slot_type',['Regular','Proxy'])->after('slot_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students_attendance', function (Blueprint $table) {
            //
        });
    }
};
