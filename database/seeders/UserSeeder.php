<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "Akun Admin",
                "email" => "admin@iglobal.com",
                "username" => "admin",
                "role_id" => 1,
                "password" => bcrypt('secret'),
            ],
            [
                "name" => "Akun Karyawan",
                "email" => "employee@iglobal.com",
                "username" => "employee",
                "role_id" => 2,
                "password" => bcrypt('secret'),
            ],
            [
                "name" => "Akun Karyawan 2",
                "email" => "employee2@iglobal.com",
                "username" => "employee2",
                "role_id" => 2,
                "password" => bcrypt('secret'),
            ],
            [
                "name" => "Akun Karyawan 3",
                "email" => "employee3@iglobal.com",
                "username" => "employee3",
                "role_id" => 2,
                "password" => bcrypt('secret'),
            ],
        ];

        foreach ($data as $n => $item) {
            try {
                $user = User::updateOrCreate(
                    [
                        "email" => $item['email'],
                    ],
                    $item
                );
                $user->profile()->updateOrCreate(
                    [
                        "user_id" => $user->id,
                    ],
                    [
                        "name" => $item['name'],
                    ]
                );
            } catch (\Exception $e) {
                Log::error($e);
            }
        }
    }
}
