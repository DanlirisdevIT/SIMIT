<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_budget extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'group',
        'quantity',
        'unitPrice',
        'totalPrice',
        'description'
    ];

    protected $table = "efrata_budgets";

    public function efrata_permintaans()
    {
        return $this->belongsTo(Efrata_Permintaan::class, 'efrata_permintaan_id', 'id');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    public function pemasukans()
    {
        return $this->hasOne(Pemasukan::class, 'budget_id', 'id');
    }
}
