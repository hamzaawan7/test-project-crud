<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(20)->create();

        foreach ($users as $user) {
            Interest::factory()->count(3)->create(['user_id' => $user->id]);
        }
    }
}
