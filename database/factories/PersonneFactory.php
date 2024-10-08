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
            'cin' => $this->faker->unique->randomNumber(4),
            'tel' => $this->faker->unique->phoneNumber,
            'dateNaissance' =>  $this->faker->date(),
            'nationalite' => $this->faker->country,
            'genre' => $this->faker->randomElement(['Masculin', 'Féminin']),
            'lieuNaissance' => $this->faker->city,
            'emailInstitutionne' =>  $this->faker->unique()->safeEmail,
            'situationFamiliale'=> $this->faker->randomElement(['Célibataire', 'Divorcé','Marié'])
        ];
    }
}
