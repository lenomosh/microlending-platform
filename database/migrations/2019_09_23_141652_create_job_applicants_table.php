<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applicants', function (Blueprint $table) {
            $table->uuid('applicant_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('id_number');
            $table->string('kra');
            $table->string('email');
            $table->date('dob');
            $table->string('location');
            $table->string('phone');
            $table->string('education_level');
            $table->string('current_job');
            $table->string('experience');
            $table->string('availability');
//            $table->string('cv');
//            $table->text('other_documents');
            $table->longText('application_letter');
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
        Schema::dropIfExists('job_applicants');
    }
}
