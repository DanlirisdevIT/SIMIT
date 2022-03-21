<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danliris_Ups extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'danliris_ups';

    protected $fillable = ['datafile', 'created_at', 'updated_at'];
}
