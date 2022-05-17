<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDlAntrianservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dl_antrianservices', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('danliris_history_id');
            $table->foreign('danliris_history_id')->references('id')->on('danliris_histories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('username', 255);
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('asset_ip', 255);
            $table->string('status', 255)->nullable();
            $table->string('prioritas', 255)->nullable();
            $table->string('barcode', 255)->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('nama_teknisi', 255)->nullable();
            $table->string('jenis_kerusakan', 255)->nullable();
            $table->string('penyebab_kerusakan', 255)->nullable();
            $table->string('tindakan_perbaikan', 255)->nullable();
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
        Schema::dropIfExists('dl_antrianservices');
    }
}
