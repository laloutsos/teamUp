<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\User;


class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get test user
        $testUser = User::where('email', 'test@test.com')->firstOrFail();

        // Get all games ids
        $gameIds = Game::pluck('id')->toArray();

        // Randomly select games to Bookmark 
        $randomGameIds = array_rand($gameIds, 3);

        // Attach the selected games as bookmarks for the test user
        foreach ($randomGameIds as $gameId) {
            $testUser->bookmarkedGames()->attach($gameIds[$gameId]);
        }
    }
}
