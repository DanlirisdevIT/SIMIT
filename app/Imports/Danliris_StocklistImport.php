<?php

namespace App\Imports;

use App\Models\Danliris_Stocklist;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class Danliris_StocklistImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Danliris_Stocklist([
            
            'username' => $row['username'],
            'nama_barang' => $row['nama_barang'],
            'manufacture' => $row['manufacture'],
            'merk' => $row['merk'],
            'processor' => $row['processor'],
            'power_supply' => $row['power_supply'],
            'casing' => $row['casing'],
            'hddslot1' => $row['hddslot1'],
            'hddslot2' => $row['hddslot2'],
            'ramslot1' => $row['ramslot1'],
            'ramslot2' => $row['ramslot2'],
            'fan_processor' => $row['fan_processor'],
            'dvd_internal' => $row['dvd_internal'],
            'asset_ip' => $row['asset_ip'],
            'company' => $row['company'],
            'divisi' => $row['divisi'],
            'unit' => $row['unit'],
            'location' => $row['location'],
            'status' => $row['status']
        ]);
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required'
            ],
            
            'power_supply' => [
                'nullable'
            ],

            'casing' => [
                'nullable'
            ],

            'hddslot2' => [
                'nullable'
            ],

            'ramslot2' => [
                'nullable'
            ]
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 1;
    }

}
