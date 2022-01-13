<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['category_name', 'category_type'];

    public function assets(){
        return $this->hasOne(Asset::class, 'category_id', 'id');
    }

    public function permintaans(){
        return $this->hasOne(Permintaan::class, 'category_id', 'id');
    }

    public function budgets(){
        return $this->hasOne(Budget::class, 'category_id', 'id');
    }

    public function antrian_services()
    {
        return $this->hasOne(AntrianService::class, 'category_id', 'id');
    }

    public function service_masuk_assets()
    {
        return $this->hasOne(ServiceMasukAsset::class, 'category_id', 'id');
    }
}
