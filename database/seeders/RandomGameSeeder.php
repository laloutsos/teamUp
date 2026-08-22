<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\User;

class RandomGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testUser = User::where('email', 'test@test.com')->first();

        $randomUsers = User::where('email', '!=', 'test@test.com')->get();

        // Create 3 games for the test user
        Game::factory(3)->create([
            'user_id' => $testUser->id,
        ]);

        // Create 7 games and assign each one to a random user
        Game::factory(7)->create()->each(function ($game) use ($randomUsers) {
            $game->update([
                'user_id' => $randomUsers->random()->id,
            ]);
        });
    }
}
