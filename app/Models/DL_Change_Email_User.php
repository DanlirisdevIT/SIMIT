<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DL_Change_Email_User extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'dl_change_email_users';

    protected $fillable = ['datafile', 'created_at', 'updated_at'];
}
