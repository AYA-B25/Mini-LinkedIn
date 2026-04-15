<?php

namespace Database\Factories;

use App\Models\Competence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Competence>
 */
class CompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->randomElement(["HTML","CSS","JavaScript","PHP","Node.js","Express.js"]),
            'categorie' => fake()->randomElement(['frontend','backend','devops','design', 'mobile'])
        ];
    }
}
