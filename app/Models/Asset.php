<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacture;

class Asset extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'asset_name',
        'model_number',
        'EOL',
        'notes',
        'images',
    ];

    protected $table = "assets";

    public function manufactures()
    {
        return $this->belongsTo(Manufacture::class, 'manufacture_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function danliris_permintaans()
    {
        return $this->hasMany(Danliris_Permintaan::class, 'asset_id', 'id');
    }

    public function efrata_permintaans()
    {
        return $this->hasOne(Efrata_Permintaan::class, 'asset_id', 'id');
    }

    public function ag_permintaans()
    {
        return $this->hasOne(AG_Permintaan::class, 'asset_id', 'id');
    }

    // public function Budgets(){
    //     return $this->hasOne(Budget::class, 'asset_id', 'id');
    // }
    public function ag_budgets(){
        return $this->hasOne(AG_budget::class, 'asset_id', 'id');
    }
    public function danliris_budgets(){
        return $this->hasOne(Danliris_budget::class, 'asset_id', 'id');
    }
    public function efrata_budgets(){
        return $this->hasOne(Efrata_budget::class, 'asset_id', 'id');
    }

    public function danliris_histories(){
        return $this->hasOne(Danliris_History::class, 'asset_id', 'id');
    }

    public function efrata_histories(){
        return $this->hasOne(Efrata_History::class, 'asset_id', 'id');
    }

    public function AG_histories(){
        return $this->hasOne(AG_History::class, 'asset_id', 'id');
    }
    public function danliris_pemasukans()
    {
        return $this->hasOne(Danliris_Pemasukan::class, 'asset_id', 'id');
    }

    public function danliris_pengeluarans()
    {
        return $this->hasOne(Danliris_Pengeluaran::class, 'asset_id', 'id');
    }

    public function danliris_movement()
    {
        return $this->hasOne(Danliris_Movement::class, 'asset_id', 'id');
    }

    public function efrata_pengeluarans()
    {
        return $this->hasOne(Efrata_Pengeluaran::class, 'asset_id', 'id');
    }

    public function ag_pengeluarans()
    {
        return $this->hasOne(AG_Pengeluaran::class, 'asset_id', 'id');
    }

    public function ag_pemasukans()
    {
        return $this->hasOne(AG_Pemasukan::class, 'asset_id', 'id');
    }

    public function efrata_pemasukans()
    {
        return $this->hasOne(Efrata_Pemasukan::class, 'asset_id', 'id');
    }
}
