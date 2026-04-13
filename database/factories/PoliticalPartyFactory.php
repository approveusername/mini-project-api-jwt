<?php

namespace Database\Factories;
use App\Models\PoliticalParty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=PoliticalParty>
 */
class PoliticalPartyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PoliticalParty::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
