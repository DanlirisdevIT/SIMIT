<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanlirisHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danliris_histories', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('asset_id');
            // $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('asset_name', 255);
            $table->string('asset_ip', 255);
            $table->string('barcode', 255);
            // $table->unsignedBigInteger('danliris_pengeluaran_id')->nullable();
            // $table->foreign('danliris_pengeluaran_id')->references('id')->on('danliris_pengeluarans')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('pengeluaran_id');
            // $table->foreign('pengeluaran_id')->references('id')->on
            // ('danliris_pengeluarans')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal_pengeluaran');
            // $table->date('date');
            $table->string('username', 255);
            $table->string('unit_name')->nullable();
            $table->string('division_name')->nullable();
            $table->string('category_type')->nullable();
            $table->string('category_name')->nullable();
            // $table->unsignedBigInteger('division_id');
            // $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('unit_id');
            // $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status', 255);
            $table->string('createdBy');
            $table->dateTime('createdUtc');
            $table->string('updatedBy')->nullable();
            $table->dateTime('updatedUtc')->nullable();
            $table->string('deletedBy')->nullable();
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
        Schema::dropIfExists('danliris_histories');
    }
}
