<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgPemasukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ag_pemasukans', function (Blueprint $table) {
            $table->id();
            // $table->string('ag_uid');
            $table->date('date');
            $table->string('barcode');
            $table->string('pemasukan_type');
            // $table->string('status');
            $table->string('replacement_by')->nullable();
            $table->string('category_type');
            $table->string('category_name');
            $table->string('asset_name');
            $table->string('user_peminta');
            // $table->unsignedBigInteger('ag_permintaan_id')->nullable();
            // $table->foreign('ag_permintaan_id')->references('id')->on('ag_permintaans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('ag_budget_id')->nullable();
            $table->foreign('ag_budget_id')->references('id')->on('ag_budgets')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('manufacture_id')->nullable();
            $table->foreign('manufacture_id')->references('id')->on('manufactures')->onDelete('cascade')->onUpdate('cascade');
            // $table->unsignedBigInteger('category_id')->nullable();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->string('merk')->nullable();
            $table->string('motherboard')->nullable();
            $table->string('processor')->nullable();
            $table->string('power_supply')->nullable();
            $table->string('casing')->nullable();
            $table->string('harddisk_slot_1')->nullable();
            $table->string('harddisk_slot_2')->nullable();
            $table->string('ram_slot_1')->nullable();
            $table->string('ram_slot_2')->nullable();
            $table->string('fan_processor')->nullable();
            $table->string('dvd_internal')->nullable();
            $table->string('id_seri')->nullable();
            $table->string('no_seri')->nullable();
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
        Schema::dropIfExists('ag_pemasukans');
    }
}
