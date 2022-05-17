<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_Change_Pc_user extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'ag_change_pc_users';

    protected $fillable = ['datafile', 'document_name', 'created_at', 'updated_at'];
}
