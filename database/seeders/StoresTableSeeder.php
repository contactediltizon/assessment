<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoresTableSeeder extends Seeder
{
    public function run()
    {
        // Example data
        $stores = [
            [
                'brand' => 'Pizza Hut',
                'store_number' => '1234',
                'address' => '1234 Main St, Springfield, IL',
                'total_revenue' => 500000.00,
                'total_profit' => 100000.00,
                'user_id' => 1 // Ensure this user_id exists in the users table
            ],
            [
                'brand' => 'Taco Bell',
                'store_number' => '5678',
                'address' => '5678 Elm St, Springfield, IL',
                'total_revenue' => 300000.00,
                'total_profit' => 50000.00,
                'user_id' => 2 // Ensure this user_id exists in the users table
            ],
            // Add more stores as needed
        ];

        // Insert data
        DB::table('stores')->insert($stores);
    }
}
