<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianService extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'date',
        'name',
        'nama_barang',
        'barcode',
        'no_seri',
        'status',
        'prioritas'
    ];

    protected $table = 'antrian_services';

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
