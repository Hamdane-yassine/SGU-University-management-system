<?php

namespace Database\Factories;

use App\Models\Personne;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personne::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->name(),
            'adressePersonnele' => $this->faker->address,
            'cin' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->phoneNumber,
            'dateNaissance' =>  $this->faker->date(),
            'nationalite' => $this->faker->colorName,
            'lieuNaissance' => $this->faker->name(),
            'emailInstitutionne' =>  $this->faker->safeEmail,

        ];
    }
}
