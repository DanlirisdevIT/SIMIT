<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class Manufacture extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['manufactureName', 'url', 'supportEmail', 'supportPhone', 'Image'];

    public function assets(){
        return $this->hasOne(Asset::class, 'manufacture_id', 'id');
    }

    public function danliris_pemasukans()
    {
        return $this->hasOne(Danliris_Pemasukan::class, 'manufacture_id', 'id');
    }

    public function ag_pemasukans()
    {
        return $this->hasOne(AG_Pemasukan::class, 'manufacture_id', 'id');
    }

    public function efrata_pemasukans()
    {
        return $this->hasOne(Efrata_Pemasukan::class, 'manufacture_id', 'id');
    }
}
