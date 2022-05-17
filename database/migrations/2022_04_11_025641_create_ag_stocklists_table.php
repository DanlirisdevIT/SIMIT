<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgStocklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ag_stocklists', function (Blueprint $table) {
            $table->id();
            $table->string('username', 255);
            $table->string('nama_barang', 255);
            $table->string('manufacture', 255);
            $table->string('merk', 255);
            $table->string('processor', 255);
            $table->string('power_supply', 255);
            $table->string('casing', 255);
            $table->string('hddslot1', 255);
            $table->string('hddslot2', 255);
            $table->string('ramslot1', 255) ;
            $table->string('ramslot2', 255) ;
            $table->string('fan_processor', 255);
            $table->string('dvd_internal', 255);
            $table->string('asset_ip', 255);
            $table->string('company', 255);
            $table->string('divisi', 255);
            $table->string('unit', 255);
            $table->string('location', 255);
            $table->string('status', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ag_stocklists');
    }
}
