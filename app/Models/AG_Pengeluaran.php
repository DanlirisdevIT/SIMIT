<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_Pengeluaran extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'barcode',
        'quantity',
        'description',
        'asset_ip'
    ];

    protected $table = "ag_pengeluarans";

    public function ag_pemasukans()
    {
        return $this->belongsTo(ag_Pemasukan::class, 'ag_pemasukan_id', 'id');
    }

    public function ag_permintaans()
    {
        return $this->belongsTo(ag_Permintaan::class, 'ag_permintaan_id', 'id');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
