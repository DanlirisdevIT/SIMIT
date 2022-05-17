<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_Change_Wifi extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'efrata_change_wifi';

    protected $fillable = ['datafile', 'document_name', 'created_at', 'updated_at'];
}
