<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('game_listings', function (Blueprint $table) {
            if (!Schema::hasColumn('game_listings', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('game_listings', 'bet')) {
                $table->integer('bet')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'tags')) {
                $table->string('tags')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'game_type')) {
                $table->enum('game_type', ['Football', 'Basketball', 'Volleyball'])->default('Football');
            }
            if (!Schema::hasColumn('game_listings', 'competitive')) {
                $table->boolean('competitive')->default(false);
            }
            if (!Schema::hasColumn('game_listings', 'more_information')) {
                $table->text('more_information')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'exact_location')) {
                $table->string('exact_location')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'contact_email')) {
                $table->string('contact_email')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'contact_phone')) {
                $table->string('contact_phone')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'team_name')) {
                $table->string('team_name')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'team_information')) {
                $table->string('team_information')->nullable();
            }
            if (!Schema::hasColumn('game_listings', 'team_logo')) {
                $table->string('team_logo')->nullable();
            }
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_listings', function (Blueprint $table) {
            if (Schema::hasColumn('game_listings', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            $table->dropColumn([
                'bet',
                'tags',
                'game_type',
                'competitive',
                'more_information',
                'city',
                'exact_location',
                'contact_email',
                'contact_phone',
                'team_name',
                'team_information',
                'team_logo'
            ]);
        });
    }
};
