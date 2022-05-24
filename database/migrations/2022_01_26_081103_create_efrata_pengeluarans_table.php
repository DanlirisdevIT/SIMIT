<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEfrataPengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efrata_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('pengeluaran_type');
            $table->string('barcode');
            // $table->integer('quantity')->nullable();
            $table->string('description')->nullable();
            $table->string('username')->nullable();
            $table->string('replacement_username')->nullable();
            $table->string('unit_name')->nullable();
            $table->string('division_name')->nullable();
            $table->string('category_type')->nullable();
            $table->string('category_name')->nullable();
            $table->string('asset_name')->nullable();
            $table->string('asset_ip')->nullable();
            // $table->unsignedBigInteger('asset_id');
            // $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('efrata_pemasukan_id')->nullable();
            $table->foreign('efrata_pemasukan_id')->references('id')->on('efrata_pemasukans')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('company_id');
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('division_id');
            // $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('unit_id');
            // $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('efrata_permintaan_id');
            // $table->foreign('efrata_permintaan_id')->references('id')->on('efrata_permintaans')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('location_id');
            // $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('efrata_pengeluarans');
    }
}
