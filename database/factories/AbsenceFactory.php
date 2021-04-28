<?php

namespace Database\Factories;

use App\Models\Absence;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbsenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Absence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idProf' => function (){
                return \App\Models\Professeur::factory()->create()->pluc('idProf');
            },
            'idMatier' => function (){
                return \App\Models\Matiere::factory()->create()->pluc('idMatier');
            },
        ];
    }
}
