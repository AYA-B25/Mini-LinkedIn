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
        User::factory(10)
            ->has(Profil::factory())
            ->has(Competence::factory(3))
            ->create();
    }
}
