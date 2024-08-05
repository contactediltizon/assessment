<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StoreSeeder::class,
        ]);
        
        // Create a user
        $user = User::factory()->create([
            'email' => 'owner@example.com',
            'password' => bcrypt('password')
        ]);

        // Create stores and associate them with the user
        Store::factory(5)->create([
            'user_id' => $user->id,
        ]);
    }
}
