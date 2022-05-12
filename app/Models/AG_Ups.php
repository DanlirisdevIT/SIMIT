<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_Ups extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'ag_ups';

    protected $fillable = ['datafile', 'created_at', 'updated_at'];
}
