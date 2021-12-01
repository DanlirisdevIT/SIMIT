<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['manufactureName', 'Url', 'supportEmail', 'supportPhone', 'image'];
}