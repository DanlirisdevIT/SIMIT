<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['division_name'];

    public function units(){
        return $this->hasOne(Unit::class, 'division_id', 'id');
    }

    public function permintaans(){
        return $this->hasOne(Permintaan::class, 'division_id', 'id');
    }
}
