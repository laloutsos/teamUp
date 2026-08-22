<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_listings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->text('description');
            $table->integer('bet')->default(0);
            $table->string('tags')->nullable();
            $table->string('game_type');
            $table->boolean('competitive')->default(false);
            $table->text('more_information')->nullable();

            $table->string('city');
            $table->string('exact_location');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();

            $table->string('team_name')->nullable();
            $table->text('team_description')->nullable();
            $table->string('team_logo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_listings');
    }
};
