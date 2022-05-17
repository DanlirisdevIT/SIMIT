<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_Movement extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'danliris_movements';

    protected $fillable = [
        'quantity',
        'barcode',
        'status'
    ];

    public function danliris_permintaans()
    {
        return $this->belongsTo(Danliris_Permintaan::class, 'danliris_permintaan_id', 'id');
    }

    public function assets()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
