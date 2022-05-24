<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanlirisMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danliris_movements', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('asset_id')->nullable();
            // $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('asset_ip')->nullable();
            $table->string('asset_name')->nullable();
            // $table->integer('quantity')->nullable();
            $table->string('barcode')->nullable();
            // $table->unsignedBigInteger('permintaan_id');
            // $table->foreign('permintaan_id')->references('id')->on('permintaans')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('danliris_permintaan_id')->nullable();
            // $table->foreign('danliris_permintaan_id')->references('id')->on('danliris_permintaans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('danliris_movements');
    }
}
