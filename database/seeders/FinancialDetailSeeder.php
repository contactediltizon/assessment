<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FinancialDetail;
use App\Models\Store;
use Carbon\Carbon;

class FinancialDetailSeeder extends Seeder
{
    public function run()
    {
        $store = Store::first(); // Assuming there is at least one store

        for ($i = 0; $i < 365; $i++) {
            FinancialDetail::create([
                'store_id' => $store->id,
                'date' => Carbon::now()->subDays($i),
                'revenue' => rand(1000, 5000),
                'food_cost' => rand(200, 1000),
                'labor_cost' => rand(100, 800),
                'profit' => rand(200, 2000),
            ]);
        }
    }
}

