<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('candidate_id');
            $table->foreign('candidate_id', 'candidate_id_fk_476000')->references('id')->on('candidates')->onDelete('cascade');
            $table->tinyInteger('is_cv');
            $table->string('document');
            $table->timestamps();
        });
    }

}
