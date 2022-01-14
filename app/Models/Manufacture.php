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

    public function pemasukans()
    {
        return $this->hasOne(Pemasukan::class, 'manufacture_id', 'id');
    }
}
