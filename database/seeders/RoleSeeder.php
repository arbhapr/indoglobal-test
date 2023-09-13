<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class RoleSeeder extends Seeder
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
                "id" => 1,
                "name" => "Admin",
            ],
            [
                "id" => 2,
                "name" => "Employee",
            ],
        ];

        foreach ($data as $n => $item) {
            try {
                $user = Role::updateOrCreate(
                    [
                        "id" => $item['id'],
                    ],
                    $item
                );
            } catch (\Exception $e) {
                Log::error($e);
            }
        }
    }
}
