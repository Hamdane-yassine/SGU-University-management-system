<?php

namespace Database\Factories;

use App\Models\Chefdep;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChefdepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chefdep::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idProf' => function (){
                return \App\Models\Professeur::factory()->create()->get()[0]['idProf'];
            },
            'idDepartement' => function (){
                return \App\Models\Departement::factory()->create()->get()[0]['idDepartement'];
            }
        ];
    }
}
