<?php

namespace Database\Seeders;

use App\Models\MCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MCategorySeeder extends Seeder
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
                "name" => "Camera",
            ],
            [
                "id" => 2,
                "name" => "Clothes",
            ],
            [
                "id" => 3,
                "name" => "Smartphone",
            ],
        ];

        foreach ($data as $n => $item) {
            try {
                $category = MCategory::updateOrCreate(
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
