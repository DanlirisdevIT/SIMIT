<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['location_name'];

    public function units(){
        return $this->hasOne(Unit::class, 'location_id', 'id');
    }

    public function danliris_pengeluarans()
    {
        return $this->hasOne(Danliris_Pengeluaran::class, 'location_id', 'id');
    }

    public function efrata_pengeluarans()
    {
        return $this->hasOne(Efrata_Pengeluaran::class, 'location_id', 'id');
    }
}
