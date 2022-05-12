<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_Temperature extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'efrata_temperatures';

    protected $fillable = ['datafile', 'created_at', 'updated_at'];
}
