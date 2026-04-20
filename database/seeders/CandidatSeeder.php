<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profil;
use App\Models\Competence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::factory(10)->create(['role' => 'candidat'])->each(function ($user) {


            $profil = Profil::factory()->create(['user_id' => $user->id]);


            $competences = Competence::inRandomOrder()->take(rand(2, 3))->get();

            foreach ($competences as $competence) {
                $profil->competences()->attach($competence->id, [
                    'niveau' => fake()->randomElement(['debutant', 'intermediaire', 'expert'])
                ]);
            }
        });

    }
}
