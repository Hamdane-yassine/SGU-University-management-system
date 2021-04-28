<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etudiant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idPersonne' => function(){
                return \App\Models\Personne::factory()->create()->get()[0]['idPersonne'];
            },
            'idFiliere' => function(){
                return \App\Models\Filiere::factory()->create()->get()[0]['idFiliere'];
            },
            'cne'=>$this->faker->randomDigit(),
            'apogee'=>$this->faker->randomDigit(),
            'anneeDuBaccalaureat'=>$this->faker->date(),
            'cinMere'=>$this->faker->randomDigit(),
            'cinPere'=>$this->faker->randomDigit(),
            'regimeDeCovertureMedicale'=>'yes',
        ];
    }
}
