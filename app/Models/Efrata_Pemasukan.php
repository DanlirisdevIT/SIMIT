<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_Pemasukan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "efrata_pemasukans";

    public function manufactures()
    {
        return $this->belongsTo(Manufacture::class, 'manufacture_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function efrata_permintaans()
    {
        return $this->belongsTo(Efrata_Permintaan::class, 'efrata_permintaan_id', 'id');
    }

    public function efrata_pengeluarans()
    {
        return $this->hasOne(Efrata_Pengeluaran::class, 'efrata_pemasukan_id', 'id');
    }

    public function efrata_budgets()
    {
        return $this->belongsTo(Efrata_Budget::class, 'efrata_budget_id', 'id');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
