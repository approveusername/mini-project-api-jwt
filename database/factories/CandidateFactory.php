<?php

namespace Database\Factories;
use App\Models\Candidate;
use App\Models\PoliticalParty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Candidate::class;

    public function definition()
    {
        return [
            'candidate_name' => fake()->name(),
            'political_party_id' => PoliticalParty::factory(),
        ];
    }
}
