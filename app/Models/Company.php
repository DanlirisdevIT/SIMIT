<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['companyName'];

    public function units(){
        return $this->hasOne(Unit::class, 'company_id', 'id');
    }

    // public function permintaans(){
    //     return $this->hasOne(Permintaan::class, 'company_id', 'id');
    // }

    public function danliris_permintaans()
    {
        return $this->hasOne(Danliris_Permintaan::class, 'company_id', 'id');
    }

    public function danliris_pengeluarans()
    {
        return $this->hasOne(Danliris_Pengeluaran::class, 'company_id', 'id');
    }

    public function efrata_pengeluarans()
    {
        return $this->hasOne(Efrata_Pengeluaran::class, 'company_id', 'id');
    }

    public function efrata_permintaans()
    {
        return $this->hasOne(Efrata_Permintaan::class, 'company_id', 'id');
    }

    public function ag_permintaans()
    {
        return $this->hasOne(AG_Permintaan::class, 'company_id', 'id');
    }

    public function users(){
        return $this->hasOne(User::class, 'company_id', 'id');
    }
}
