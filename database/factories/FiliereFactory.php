<?php

namespace Database\Factories;

use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class FiliereFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Filiere::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idDepartement' => function (){
                if(\App\Models\Departement::count())
                    return $this->faker->randomElement(\App\Models\Departement::pluck('idDepartement'));
                return \App\Models\Departement::factory()->create()->get()[0]['idDepartement'];
            },
            'nom'=>$this->faker->word(),
            'niveau'=>$this->faker->randomNumber(8),
        ];
    }
}
