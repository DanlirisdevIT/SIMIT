<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_budget extends Model
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

    protected $table = "ag_budgets";

    // public function permintaans()
    // {
    //     return $this->belongsTo(Permintaan::class, 'permintaan_id', 'id');
    // }
    public function ag_permintaans()
    {
        return $this->belongsTo(AG_Permintaan::class, 'ag_permintaan_id', 'id');
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
