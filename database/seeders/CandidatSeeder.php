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
        User::factory(10)->create()->each(function ($user) {

            $profil = Profil::factory()->create([
                'user_id' => $user->id
            ]);

            $profil->competences()->attach(
                Competence::factory(3)->create()->pluck('id'),
                ['niveau' => 'intermediaire']
            );

        });
    }
}
