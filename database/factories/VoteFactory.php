<?php

namespace Database\Factories;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vote::class;
    
    public function definition()
    {
        return [
            'user_id' => User::factory(),  // Automatically links user_id to a user
            'vote_name' => $this->faker->word,
        ];
    }
}
