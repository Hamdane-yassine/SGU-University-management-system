<?php

namespace Database\Factories;

use App\Models\Professeur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfesseurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Professeur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idUtilisateur' => function (){
                return \App\Models\User::factory()->create()->pluck('idUtilisateur')[0];
            },
            'idDepartement' => function (){
                return \App\Models\Departement::factory()->create()->pluck('idDepartement')[0];
            },
        ];
    }
}
