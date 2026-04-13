<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vote;
use App\Models\Company;
use App\Models\PhoneNumber;
use App\Models\PoliticalParty;
use App\Models\Candidate;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(50)->create();

        $companies = [];
        foreach ($users as $user) {
            $companies[] = Company::factory()->create([
                'user_id' => $user->id, 
            ]);
        }

        foreach ($companies as $company) {
            PhoneNumber::factory()->create([
                'company_id' => $company->id, 
            ]);
        }

        die;
        foreach ($users as $user) {
            Vote::factory()->create([
                'user_id' => $user->id, 
            ]);
        }

        $political_party = PoliticalParty::factory(100)->create();

        foreach ($political_party as $party) {
            Candidate::factory()->create([
                'political_party_id' => $party->id, 
            ]);
        }
    }
}
