<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_History extends Model
{
    use HasFactory;

    public $timestamps = false;

    
    protected $table = 'danliris_histories';

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function danliris_antrianservices()
    {
        return $this->hasOne(Danliris_Antrianservice::class, 'danliris_history_id', 'id');
    }

    // public function danliris_pengeluarans()
    // {
    //     return $this->haOne(Danliris_Pengeluaran::class, 'danliris_pengeluaran_id', 'id')l;
    // }
}
