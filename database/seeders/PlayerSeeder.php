<?php

namespace Database\Seeders;
use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Player::factory(30)->withTeam()->create();
        Player::factory(10)->withoutTeam()->create();
    }
}
