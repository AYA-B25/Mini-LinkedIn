<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competence;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competences = [
            ['nom' => 'HTML',         'categorie' => 'frontend'],
            ['nom' => 'CSS',          'categorie' => 'frontend'],
            ['nom' => 'JavaScript',   'categorie' => 'frontend'],
            ['nom' => 'PHP',          'categorie' => 'backend'],
            ['nom' => 'Laravel',      'categorie' => 'backend'],
            ['nom' => 'Node.js',      'categorie' => 'backend'],
            ['nom' => 'Express.js',   'categorie' => 'backend'],
            ['nom' => 'React',        'categorie' => 'frontend'],
            ['nom' => 'Docker',       'categorie' => 'devops'],
            ['nom' => 'MySQL',        'categorie' => 'backend'],
        ];

        foreach ($competences as $competence) {
            Competence::create($competence);
        }
    }
}