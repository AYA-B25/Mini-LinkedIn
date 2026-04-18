<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Offre;
use Illuminate\Database\Seeder;

class AdminRecruteurSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(2)->admin()->create();
        User::factory(5)
            ->recruteur()
            ->create()
            ->each(function ($recruteur) {

                Offre::factory(rand(2, 3))->create([
                    'user_id' => $recruteur->id
                ]);
            });
    }
}
