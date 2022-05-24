<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = [
            [
                'companyName' => 'Danliris',
                'createdBy' => 'superadmin',
                'createdUtc' => Carbon::now(),
                'updatedBy' => NULL,
                'updatedUtc' => NULL,
                'deletedBy' => NULL,
                'deletedUtc' => NULL,
            ],
            [
                'companyName' => 'Efrata',
                'createdBy' => 'superadmin',
                'createdUtc' => Carbon::now(),
                'updatedBy' => NULL,
                'updatedUtc' => NULL,
                'deletedBy' => NULL,
                'deletedUtc' => NULL,
            ],
            [
                'companyName' => 'AG',
                'createdBy' => 'superadmin',
                'createdUtc' => Carbon::now(),
                'updatedBy' => NULL,
                'updatedUtc' => NULL,
                'deletedBy' => NULL,
                'deletedUtc' => NULL,
            ],
            [
                'companyName' => 'Mas',
                'createdBy' => 'superadmin',
                'createdUtc' => Carbon::now(),
                'updatedBy' => NULL,
                'updatedUtc' => NULL,
                'deletedBy' => NULL,
                'deletedUtc' => NULL,
            ],
        ];

        foreach ($company as $key => $value)
        {
            Company::create($value);
        }
    }
}
