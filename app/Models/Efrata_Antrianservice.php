<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_Antrianservice extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'date',
        'status',
        'prioritas'
    ];

    protected $table = 'efrata_antrianservices';

    public function efrata_histories()
    {
        return $this->belongsTo(Efrata_History::class, 'efrata_history_id', 'id');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    public function efrata_servicefinals()
    {
        return $this->hasOne(Efrata_Servicefinal::class, 'efrata_antrianservice_id', 'id');
    }
}
