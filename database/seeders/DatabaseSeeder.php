<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncate Tables
        DB::table('game_listings')->truncate();
        DB::table('users')->truncate();
        DB::table('game_user_bookmarks')->truncate();
        DB::table('applicants')->truncate();


        $this->call(TestUserSeeder::class);
        $this->call(RandomUserSeeder::class);
        $this->call(RandomGameSeeder::class);
        $this->call(BookmarkSeeder::class);
    }
}
