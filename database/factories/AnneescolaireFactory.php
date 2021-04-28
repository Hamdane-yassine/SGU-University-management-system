<?php

namespace Database\Factories;

use App\Models\Anneescolaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnneescolaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Anneescolaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'annee'=> $this->faker->dateTimeThisYear(),
        ];
    }
}
