<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('job_id');
            $table->string('title');
            $table->longText('description');
            $table->string('location');
            $table->string('skill_id');
            $table->integer('company_id');
            $table->integer('slots');
            $table->longText('responsibility');
            $table->string('requirement_id');
            $table->string('employment_period');
            $table->longText('other_information');
            $table->integer('salary');
            $table->date('deadline');
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
        Schema::dropIfExists('jobs');
    }
}
