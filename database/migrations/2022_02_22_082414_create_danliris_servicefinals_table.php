<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanlirisServicefinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danliris_servicefinals', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('danliris_antrianservice_id');
            $table->foreign('danliris_antrianservice_id')->references('id')->on('danliris_antrianservices')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_teknisi', 255);
            $table->string('jenis_kerusakan', 255);
            $table->string('penyebab_kerusakan', 255);
            $table->string('tindakan_perbaikan', 255);
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
        Schema::dropIfExists('danliris_servicefinals');
    }
}
