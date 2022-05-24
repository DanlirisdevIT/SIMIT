<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['supplier_name', 'address', 'phone', 'agent_name', 'partner_type'];

    // public function pemasukans()
    // {
    //     return $this->hasOne(Pemasukan::class, 'supplier_id', 'id');
    // }

    public function danliris_pemasukans()
    {
        return $this->hasOne(Danliris_Pemasukan::class, 'supplier_id', 'id');
    }

    public function ag_pemasukans()
    {
        return $this->hasOne(AG_Pemasukan::class, 'supplier_id', 'id');
    }

    public function efrata_pemasukans()
    {
        return $this->hasOne(Efrata_Pemasukan::class, 'supplier_id', 'id');
    }
}
