<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['unit_name'];

    protected $table = "units";

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function antrian_services()
    {
        return $this->hasOne(AntrianService::class, 'unit_id', 'id');
    }

    // public function permintaans()
    // {
    //     return $this->hasOne(Permintaan::class, 'unit_id', 'id');
    // }

    public function danliris_permintaans()
    {
        return $this->hasOne(Danliris_Permintaan::class, 'unit_id', 'id');
    }

    public function efrata_permintaans()
    {
        return $this->hasOne(Efrata_Permintaan::class, 'unit_id', 'id');
    }

    public function ag_permintaans()
    {
        return $this->hasOne(AG_Permintaan::class, 'unit_id', 'id');
    }

    public function pemasukans()
    {
        return $this->hasOne(Pemasukan::class, 'unit_id', 'id');
    }
}
