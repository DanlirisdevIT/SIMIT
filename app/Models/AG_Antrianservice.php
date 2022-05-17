<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_Antrianservice extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'date',
        'status',
        'prioritas'
    ];

    protected $table = 'ag_antrianservices';

    public function ag_histories()
    {
        return $this->belongsTo(AG_History::class, 'ag_history_id', 'id');
    }

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

    public function ag_servicefinals()
    {
        return $this->hasOne(AG_Servicefinal::class, 'ag_antrianservice_id', 'id');
    }

    public function ag_analyses()
    {
        return $this->hasOne(AG_Analysis::class, 'ag_antrianservice_id', 'id');
    }
}
