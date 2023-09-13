<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProductSeeder extends Seeder
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
                "category_id" => 1,
                "name" => "D-SLR",
                "qty" => 10,
                "price" => 1000,
            ],
            [
                "category_id" => 1,
                "name" => "Optical",
                "qty" => 15,
                "price" => 1200,
            ],
            [
                "category_id" => 1,
                "name" => "Digital",
                "qty" => 9,
                "price" => 300,
            ],
            [
                "category_id" => 2,
                "name" => "Long Sleeve",
                "qty" => 30,
                "price" => 20,
            ],
            [
                "category_id" => 2,
                "name" => "Jacket",
                "qty" => 30,
                "price" => 40,
            ],
            [
                "category_id" => 2,
                "name" => "Tuxedo",
                "qty" => 50,
                "price" => 90,
            ],
            [
                "category_id" => 3,
                "name" => "Xiao-1",
                "qty" => 10,
                "price" => 300,
            ],
            [
                "category_id" => 3,
                "name" => "Xiao-2",
                "qty" => 19,
                "price" => 400,
            ],
            [
                "category_id" => 3,
                "name" => "Xiao-3",
                "qty" => 10,
                "price" => 900,
            ],
            [
                "category_id" => 3,
                "name" => "Xiao-4",
                "qty" => 12,
                "price" => 1200,
            ],
            [
                "category_id" => 3,
                "name" => "Xiao-5",
                "qty" => 14,
                "price" => 1400,
            ],
        ];

        foreach ($data as $n => $item) {
            try {
                $category = Product::updateOrCreate(
                    [
                        "name" => $item['name'],
                    ],
                    $item
                );
            } catch (\Exception $e) {
                Log::error($e);
            }
        }
    }
}
