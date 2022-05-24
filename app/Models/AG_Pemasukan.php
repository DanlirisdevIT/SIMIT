<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_Pemasukan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "ag_pemasukans";

    public function manufactures()
    {
        return $this->belongsTo(Manufacture::class, 'manufacture_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function ag_permintaans()
    {
        return $this->belongsTo(AG_Permintaan::class, 'ag_permintaan_id', 'id');
    }

    public function ag_pengeluarans()
    {
        return $this->hasOne(AG_Pengeluaran::class, 'ag_pemasukan_id', 'id');
    }

    public function ag_budgets()
    {
        return $this->belongsTo(AG_Budget::class, 'ag_budget_id', 'id');
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
