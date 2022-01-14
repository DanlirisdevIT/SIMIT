<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMasukAsset extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'barcode',
        'no_seri'
    ];

    protected $table = "service_masuk_assets";

    public function antrian_services()
    {
        return $this->belongsTo(AntrianService::class, 'antrianservice_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
