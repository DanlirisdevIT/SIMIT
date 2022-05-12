<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEfrataChangeWifiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efrata_change_wifi', function (Blueprint $table) {
            $table->id();
            $table->string('datafile');
            $table->string('createdBy', 255)->nullable();
            $table->date('created_at')->nullable();
            $table->string('updatedBy', 255)->nullable();
            $table->date('updated_at')->nullable();
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
        Schema::dropIfExists('efrata_change_wifi');
    }
}
