<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class TermsConditionsCreateTermsConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('application_no', 100)->unique();
            $table->string('post_applied_for')->nullable();
            $table->string('passport_photo')->nullable();
            $table->string('full_name', 255);
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('father_name')->nullable();
            $table->string('category', 50)->nullable();
            $table->string('other_category_specify')->nullable();
            $table->string('caste_certificate')->nullable();
            $table->date('dob')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->enum('marital_status', ['Married', 'Single'])->nullable();
            $table->text('communication_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('contact_phone', 30)->nullable();
            $table->string('email_id')->nullable();
            $table->string('nationality')->nullable();
            $table->boolean('citizen_india')->nullable();
            $table->string('belong_state')->nullable();
            $table->boolean('migrated')->nullable();
            $table->string('basic_degree_type')->nullable();
            $table->text('science_education_details')->nullable();
            $table->text('engineering_education_details')->nullable();

            $table->boolean('nepal_sikkim')->nullable();
            $table->string('religion')->nullable();
            $table->boolean('religion_changed')->nullable();
            $table->string('present_work_nature')->nullable();
            $table->string('other_work_specify')->nullable();
            $table->text('experience_details')->nullable();

            // Additional boolean/single fields
            $table->boolean('outside_india')->nullable();
            $table->boolean('suspended')->nullable();
            $table->boolean('arrested')->nullable();
            $table->boolean('endorsement_agreement')->nullable();

            $table->boolean('govt_servant')->nullable();
            $table->string('appointment_nature')->nullable();

            // File uploads & other details
            $table->string('endorsement_upload')->nullable();

            // Pay & joining
            $table->boolean('accept_minimum_pay')->nullable();
            $table->string('expected_pay')->nullable();
            $table->string('joining_time')->nullable();

            // Referees
            $table->text('referee1')->nullable();
            $table->string('referee1_phone', 30)->nullable();
            $table->string('referee1_email')->nullable();
            $table->text('referee2')->nullable();
            $table->string('referee2_phone', 30)->nullable();
            $table->string('referee2_email')->nullable();

            // Declaration info
            $table->string('place_declaration')->nullable();

            $table->text('education_details')->nullable();
            $table->text('employment_details')->nullable();
            $table->text('country_visits')->nullable();
            $table->text('significant_publications')->nullable();

            // Publication counts
            $table->integer('pub_international_journals_num')->nullable();
            $table->integer('pub_national_journals_num')->nullable();
            $table->integer('pub_international_conferences_num')->nullable();
            $table->integer('pub_national_conferences_num')->nullable();
            $table->integer('pub_other_publications_num')->nullable();

            // Payment information
            $table->string('payment_receipt_upload')->nullable();
            $table->string('application_fee_details')->nullable();

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
        Schema::dropIfExists('terms_conditions');
    }
}
