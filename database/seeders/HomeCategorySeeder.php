<?php

namespace Database\Seeders;

use App\Models\HomeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        HomeCategory::create([
            'sel_categories' => "1,3,5,7,8",
            'no_of_products' => 5
        ]);
    }
}
