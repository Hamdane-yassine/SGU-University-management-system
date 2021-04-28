<?php

namespace Database\Factories;

use App\Models\Matiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatiereFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Matiere::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idProf' => function(){
                return \App\Models\Professeur::factory()->create()->get()[0]['idProf'];
            },
            'idModule' => function(){
              return \App\Models\Module::factory()->create()->get()[0]['idModule'];
            },
            'nom'=> $this->faker->name(),
            'vh'=> $this->faker->randomNumber(),
            'coeff'=> $this->faker->randomFloat,
        ];
    }
}
