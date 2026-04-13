<?php

namespace Database\Factories;
use App\Models\PhoneNumber;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhoneNumber>
 */
class PhoneNumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PhoneNumber::class;
    public function definition()
    {
        return [
            'phone_number' => fake()->PhoneNumber(),
            'company_id' => Company::factory(),
        ];
    }
}
