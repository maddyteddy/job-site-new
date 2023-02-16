<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsCandidateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_job_specific_details', function (Blueprint $table) {
            $table->unsignedInteger('created_by')->nullable()->after('hourly_rate');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

}
