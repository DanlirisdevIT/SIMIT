<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_Antrianservice extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'date',
        'status',
        'prioritas',
    ];

    protected $table = 'danliris_antrianservices';
    // protected $table = 'dl_antrianservices';

    public function danliris_histories()
    {
        return $this->belongsTo(Danliris_History::class, 'danliris_history_id', 'id');
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

    // public function danliris_servicefinals()
    // {
    //     return $this->hasOne(Danliris_Servicefinal::class, 'danliris_antrianservice_id', 'id');
    // }

    // public function danliris_tidaktercapai()
    // {
    //     return $this->hasOne(Danliris_Tidaktercapai::class, 'danliris_antrianservice_id', 'id');
    // }

    // public function danliris_analyses()
    // {
    //     return $this->hasOne(Danliris_Analysis::class, 'danliris_antrianservice_id', 'id');
    // }
}
