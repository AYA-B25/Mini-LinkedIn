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
        // 10 candidats avec profil et compétences
        User::factory(10)->create(['role' => 'candidat'])->each(function ($user) {
            
            // Créer le profil
            $profil = Profil::factory()->create(['user_id' => $user->id]);

            // Ajouter 2-3 compétences aléatoires depuis la liste fixe
            $competences = Competence::inRandomOrder()->take(rand(2, 3))->get();
            
            foreach ($competences as $competence) {
                $profil->competences()->attach($competence->id, [
                    'niveau' => fake()->randomElement(['debutant', 'intermediaire', 'expert'])
                ]);
            }
        });

        
    }
}
