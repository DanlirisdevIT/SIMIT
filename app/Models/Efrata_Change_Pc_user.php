<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efrata_Change_Pc_user extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'efrata_change_pc_users';

    protected $fillable = ['datafile', 'created_at', 'updated_at'];
}
