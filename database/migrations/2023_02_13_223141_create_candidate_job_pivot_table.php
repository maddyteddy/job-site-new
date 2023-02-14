<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateJobPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_job_specific_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('candidate_id');
            $table->foreign('candidate_id', 'candidate_id_fk_476513')->references('id')->on('candidates')->onDelete('cascade');
            $table->unsignedInteger('job_id');
            $table->timestamps();
        });
    }

}
