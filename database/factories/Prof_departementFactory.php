<?php

namespace Database\Factories;

use App\Models\Departement;
use App\Models\Prof_departement;
use App\Models\Professeur;
use Illuminate\Database\Eloquent\Factories\Factory;

class Prof_departementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prof_departement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // static $i = 1;
        return [
            'idProf'=> $this->faker->randomElement(Professeur::pluck('idProf')),
            'idDepartement'=> $this->faker->randomElement(Departement::pluck('idDepartement')),
        ];
    }
}
