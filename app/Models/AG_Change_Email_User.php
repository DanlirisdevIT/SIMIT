<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AG_Change_Email_User extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $table = 'ag_change_email_users';

    protected $fillable = ['datafile', 'created_at', 'updated_at'];
}
