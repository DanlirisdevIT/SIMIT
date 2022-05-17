<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_History extends Model
{
    use HasFactory;

    public $timestamps = false;

    
    protected $table = 'efrata_histories';

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

    public function efrata_antrianservices()
    {
        return $this->hasOne(Efrata_Antrianservice::class, 'efrata_history_id', 'id');
    }
}
