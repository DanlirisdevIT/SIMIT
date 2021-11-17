<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'superadmin',
                'username' => 'superadmin',
                'password' => bcrypt('superadmin123'),
                'level' => 'superadmin',
                'createdBy' => 'superadmin',
                'createdUtc' => Carbon::now(),
                'updatedBy' => '',
                'updatedUtc' => NULL,
                'deletedBy' => '',
                'deletedUtc' => NULL,
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
