<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['division_name'];

    public function units(){
        return $this->hasOne(Unit::class, 'division_id', 'id');
    }

    // public function permintaans(){
    //     return $this->hasOne(Permintaan::class, 'division_id', 'id');
    // }

    public function danliris_permintaans()
    {
        return $this->hasOne(Danliris_Permintaan::class, 'division_id', 'id');
    }

    public function efrata_permintaans()
    {
        return $this->hasOne(Efrata_Permintaan::class, 'division_id', 'id');
    }

    public function ag_permintaans()
    {
        return $this->hasOne(AG_Permintaan::class, 'division_id', 'id');
    }

    // public function budgets(){
    //     return $this->hasOne(Budget::class, 'division_id', 'id');
    // }
    public function ag_budgets(){
        return $this->hasOne(AG_budget::class, 'division_id', 'id');
    }
    public function danliris_budgets(){
        return $this->hasOne(Danliris_budget::class, 'division_id', 'id');
    }
    public function efrata_budgets(){
        return $this->hasOne(Efrata_budget::class, 'division_id', 'id');
    }
}
