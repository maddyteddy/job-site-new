<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVendorPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vendor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_476513')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('vendor_id');
            $table->foreign('vendor_id', 'vendor_id_fk_476513')->references('id')->on('vendors')->onDelete('cascade');
        });
    }
}
