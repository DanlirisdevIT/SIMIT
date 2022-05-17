<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_History extends Model
{
    use HasFactory;

    public $timestamps = false;

    
    protected $table = 'ag_histories';

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

    public function ag_antrianservices()
    {
        return $this->hasOne(AG_Antrianservice::class, 'ag_history_id', 'id');
    }
}
