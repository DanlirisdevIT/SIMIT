<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
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

    protected $primarykey = 'id';

    protected $table = "budgets";

    public function permintaans()
    {
        return $this->belongsTo(Permintaan::class, 'permintaan_id', 'id');
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
