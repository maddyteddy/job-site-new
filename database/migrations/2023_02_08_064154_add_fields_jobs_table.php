<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('external_id')->nullable();
            $table->string('hash')->nullable();
            $table->unsignedInteger('organization')->nullable();
            //$table->string('position_name'); title
            //$table->string('description'); full_description
            $table->unsignedInteger('headcount')->nullable();
            $table->string('creator')->nullable();
            $table->string('salary_min')->nullable();
            $table->string('salary_max')->nullable();
            $table->string('currency')->nullable();
            $table->string('owner')->nullable();
          //  $table->string('address'); address
            $table->string('zipcode')->nullable();
          //  $table->string('contract_details'); // job_nature
            $table->boolean('is_published')->default(0)->nullable();
            $table->string('is_remote')->nullable();
            $table->string('status')->nullable();
            //$table->string('created_at'); created_at
            //$table->string('updated_at'); updated_at
            $table->string('career_page_url');
            $table->boolean('is_pinned_in_career_page')->default(false)->nullable();
            $table->string('industry');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
}
