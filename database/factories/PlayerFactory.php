<?php

namespace Database\Factories;
use App\Models\Team;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = [
            'Goalkeeper',
            'Right Fullback',
            'Left Fullback',
            'Center Back',
            'Center Midfield',
            'Right Midfield/Wing',
            'Forward',
            'Left Midfield/Wing',
        ];
        return [
            'name' => fake()->name(),
            'position' => fake()->randomElement($positions),
            'age' => fake()->numberBetween(18, 42),
            'nationality' => fake()->country(),
            'number_of_goals_this_season' => fake()->randomDigit(),
            'team_id' => null,
        ];
    }

    public function withTeam()
    {
        return $this->state(function (array $attributes) {

            static $assignedTeams = [];
    
            $allTeamIds = Team::pluck('id')->toArray();
    
            $availableTeamIds = array_diff($allTeamIds, $assignedTeams);
    
            if (empty($availableTeamIds)) {
                $assignedTeams = [];
                $availableTeamIds = $allTeamIds;
            }
    
            $teamId = fake()->randomElement($availableTeamIds);
            
            $assignedTeams[] = $teamId;
    
            return [
                'team_id' => $teamId,
            ];
        });
    }

    public function withoutTeam()
    {
        return $this->state([
            'team_id' => null,
        ]);
    }
}
