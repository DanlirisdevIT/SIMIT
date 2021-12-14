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
}
