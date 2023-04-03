<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $currentDate = Carbon::now();
        $sale_date = $currentDate->addDays(4);
        Sale::create([
            'sale_date' => $sale_date,
            'status' => 1,
        ]);
    }
}
