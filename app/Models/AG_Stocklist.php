<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_Stocklist extends Model
{
    use HasFactory;

    protected $table = 'ag_stocklists';

    protected $fillable = [
        'username',
        'nama_barang',
        'manufacture',
        'merk',
        'processor',
        'power_supply',
        'casing',
        'hddslot1',
        'hddslot2',
        'ramslot1',
        'ramslot2',
        'fan_processor',
        'dvd_internal',
        'asset_ip',
        'company',
        'divisi',
        'unit',
        'location',
        'status'
    ];
}
