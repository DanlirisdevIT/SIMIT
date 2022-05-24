<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_Pengeluaran extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'barcode',
        'quantity',
        'description',
        'asset_ip'
    ];

    protected $table = "danliris_pengeluarans";

    public function danliris_pemasukans()
    {
        return $this->belongsTo(Danliris_Pemasukan::class, 'danliris_pemasukan_id', 'id');
    }

    public function danliris_permintaans()
    {
        return $this->belongsTo(Danliris_Permintaan::class, 'danliris_permintaan_id', 'id');
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

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function danliris_movements()
    {
        return $this->hasOne(Danliris_Movement::class, 'danliris_movement_id', 'id');
    }

    public function danliris_histories()
    {
        return $this->hasOne(Danliris_History::class, 'danliris_history_id', 'id');
    }
}
