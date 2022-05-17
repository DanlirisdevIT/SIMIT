<?php

namespace App\Exports;

use App\Models\Danliris_Stocklist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Danliris_StocklistExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Danliris_Stocklist::all();
    }
    public function headings() :array
    {
        return [
            'Username',
            'Nama Barang',
            'Pabrikan',
            'Merk',
            'Processor',
            'Power Supply',
            'Casing',
            'HDD Slot1',
            'HDD Slot2',
            'RAM Slot1',
            'RAM Slot2',
            'Fan Processor',
            'DVD Internal',
            'IP',
            'Perusahaan',
            'Divisi',
            'Unit',
            'Lokasi',
            'Status'
        ];
    }
}
