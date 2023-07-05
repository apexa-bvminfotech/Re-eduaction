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
            $table->integer('marital_status');
            $table->string('course_id')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('emer_fullName');
            $table->string('emer_address');
            $table->string('emer_phone', 15);
            $table->string('emer_relationship');
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('work_location')->nullable();
            $table->string('office_use_email')->nullable();
            $table->string('joining_date')->nullable();
            $table->boolean('terms_conditions');
            $table->string('photo');
            $table->string('aadhaar_card');
            $table->string('last_edu_markSheet');
            $table->string('bank_passbook');
            $table->date('i_card_date')->nullable();
            $table->date('i_card_return_date')->nullable();
            $table->string('i_card_note')->nullable();
            $table->date('uniform_date')->nullable();
            $table->date('uniform_return_date')->nullable();
            $table->string('uniform_note')->nullable();
            $table->date('material_date')->nullable();
            $table->date('material_return_date')->nullable();
            $table->string('material_note')->nullable();
            $table->date('offer_letter_date')->nullable();
            $table->string('offer_letter_note')->nullable();
            $table->date('bond_date')->nullable();
            $table->string('bond_note')->nullable();
            $table->string('petrol_allowance')->nullable();
            $table->string('incentive')->nullable();
            $table->string('other_allowance')->nullable();
            $table->integer('emp_type')->default('0');
            $table->boolean('is_active')->default('0');
            $table->bigInteger('user_id');
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
