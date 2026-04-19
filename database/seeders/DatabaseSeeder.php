<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CandidatSeeder;
use Database\Seeders\AdminRecruteurSeeder;
use Database\Seeders\CompetenceSeeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([

            CompetenceSeeder::class,
            CandidatSeeder::class,
            AdminRecruteurSeeder::class,
        ]);
    }
}