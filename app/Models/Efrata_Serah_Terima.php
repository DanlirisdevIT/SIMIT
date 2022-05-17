<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_Serah_Terima extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'efrata_serah_terima';

    protected $fillable = ['datafile', 'document_name', 'created_at', 'updated_at'];
}
