<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CandidatSeeder;
use Database\Seeders\AdminRecruteurSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CandidatSeeder::class,
            AdminRecruteurSeeder::class,
        ]);
    }
}
