<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian_services', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name', 255);
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_barang', 255);
            $table->string('barcode', 255);
            $table->string('no_seri', 255);
            $table->string('status', 255);
            $table->string('prioritas', 255);
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
        Schema::dropIfExists('antrian_services');
    }
}
