<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_Serah_Terima extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'danliris_serah_terima';

    protected $fillable = ['datafile', 'created_at', 'updated_at'];
}
