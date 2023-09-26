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
                $table->foreignId('trainer_id')->constrained('trainers')->after('student_id');
                $table->foreignId('slot_id')->constrained('slots')->after('trainer_id');
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
