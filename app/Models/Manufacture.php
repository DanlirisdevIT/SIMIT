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

    protected $fillable = ['manufactureName', 'Url', 'supportEmail', 'supportPhone', 'image'];

    public function assets(){
        return $this->hasOne(Asset::class, 'manufacture_id', 'id');
    }
}
