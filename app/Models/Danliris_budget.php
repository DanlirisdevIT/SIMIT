<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_budget extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'group',
        'quantity',
        'realisasi',
        'unitPrice',
        'totalPrice',
        'description'
    ];

    protected $table = "danliris_budgets";

    // public function permintaans()
    // {
    //     return $this->belongsTo(Permintaan::class, 'permintaan_id', 'id');
    // }
    public function danliris_permintaans()
    {
        return $this->belongsTo(Danliris_Permintaan::class, 'danliris_permintaan_id', 'id');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    // public function pemasukans()
    // {
    //     return $this->hasOne(Pemasukan::class, 'budget_id', 'id');
    // }

    public function danliris_pemasukans()
    {
        return $this->hasOne(Danliris_Pemasukan::class, 'danliris_budget_id', 'id');
    }
}
