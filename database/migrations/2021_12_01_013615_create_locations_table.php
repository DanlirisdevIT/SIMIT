<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_name', 255);
            $table->string('createdBy', 255)->nullable();
            $table->dateTime('createdUtc')->nullable();
            $table->string('updatedBy', 255)->nullable();
            $table->dateTime('updatedUtc')->nullable();
            $table->string('deletedBy', 255)->nullable();
            $table->dateTime('deletedUtc')->nullable();
            $table->timestamps = false;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
