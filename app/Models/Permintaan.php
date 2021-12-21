<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'username',
        'quantity',
        'description'
    ];

    protected $table = "permintaans";

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
}
