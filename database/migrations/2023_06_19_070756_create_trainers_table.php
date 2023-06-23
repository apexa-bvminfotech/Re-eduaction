<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->string('surname');
            $table->string('name');
            $table->string('father_name');
            $table->text('address');
            $table->string('phone', 15);
            $table->date('dob');
            $table->string('qualification');
            $table->string('email_id')->unique();
            $table->string('marital_status');
            $table->string('password');
            $table->string('course_id');
            $table->string('branch_id');
            $table->string('role_id');
            $table->string('emer_fullName');
            $table->string('emer_address');
            $table->string('emer_phone', 15);
            $table->string('emer_relationship');
            $table->string('designation');
            $table->string('department');
            $table->string('work_location');
            $table->string('office_use_email');
            $table->string('joining_date');
            $table->boolean('terms_conditions');
            $table->string('photo');
            $table->string('aadhaar_card');
            $table->string('last_edu_markSheet');
            $table->string('bank_passbook');
            $table->date('i_card_date');
            $table->date('i_card_return_date');
            $table->string('i_card_note');
            $table->date('uniform_date');
            $table->date('uniform_return_date');
            $table->string('uniform_note');
            $table->date('material_date');
            $table->date('material_return_date');
            $table->string('material_note');
            $table->date('offer_letter_date');
            $table->string('offer_letter_note');
            $table->date('bond_date');
            $table->string('bond_note');
            $table->string('petrol_allowance')->nullable();
            $table->string('incentive')->nullable();
            $table->string('other_allowance')->nullable();
            $table->string('emp_type');
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
        Schema::dropIfExists('trainers');
    }
};
