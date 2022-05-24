<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_Pemasukan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "danliris_pemasukans";

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
        return $this->belongsTo(Danliris_Permintaan::class, 'danliris_permintaan_id', 'id');
    }

    public function danliris_pengeluarans()
    {
        return $this->hasOne(Danliris_Pengeluaran::class, 'danliris_pemasukan_id', 'id');
    }

    public function danliris_budgets()
    {
        return $this->belongsTo(Danliris_Budget::class, 'danliris_budget_id', 'id');
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
