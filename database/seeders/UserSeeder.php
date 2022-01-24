<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::factory()->count(50)->create();

        foreach ($users as $user) {
            Interest::factory()->count(3)->create();
        }
    }
}
