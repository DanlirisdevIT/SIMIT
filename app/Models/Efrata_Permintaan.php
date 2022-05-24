<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_Permintaan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'username',
        'quantity',
        'description'
    ];

    protected $table = "efrata_permintaans";

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    // public function budgets()
    // {
    //     return $this->hasOne(Budget::class, 'permintaan_id', 'id');
    // }
    public function efrata_budgets()
    {
        return $this->hasOne(Efrata_budget::class, 'efrata_permintaan_id', 'id');
    }

    public function efrata_pemasukans()
    {
        return $this->hasOne(Efrata_Pemasukan::class, 'efrata_permintaan_id', 'id');
    }

    public function efrata_pengeluarans()
    {
        return $this->hasOne(Efrata_Pengeluaran::class, 'efrata_permintaan_id', 'id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
