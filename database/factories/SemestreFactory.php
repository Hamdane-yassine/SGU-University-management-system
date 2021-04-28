<?php

namespace Database\Factories;

use App\Models\Semestre;
use Illuminate\Database\Eloquent\Factories\Factory;

class SemestreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Semestre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idFiliere' => function (){
                return \App\Models\Filiere::factory()->create()->pluck('idFiliere');
            },
            'idAnnee' => function (){
                return \App\Models\Anneescolaire::factory()->create()->pluck('idAnnee');
            },
            'idModule' =>function (){
                return \App\Models\Module::factory()->create()->pluck('idModule');
            },

        ];
    }
}
