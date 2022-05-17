<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_Kalibrasi_Alat extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'danliris_kalibrasi_alat';

    protected $fillable = ['datafile', 'document_name', 'created_at', 'updated_at'];
}
