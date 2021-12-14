<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacture;

class Asset extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'asset_name',
        'model_number',
        'EOL',
        'notes',
        'images',
    ];

    protected $table = "assets";

    public function manufactures()
    {
        return $this->belongsTo(Manufacture::class, 'manufacture_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
