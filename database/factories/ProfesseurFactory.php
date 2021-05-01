<?php

namespace Database\Factories;

use App\Models\Professeur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
                if(\App\Models\User::count()){
                    $arr = \App\Models\Personne::pluck('idPersonne')->toArray();
                    return $this->faker->unique()->randomElement(range(1,50));
                }
                return \App\Models\User::factory()->create()->get()[0]['id'];
            },
            'idDepartement' => function (){
                if(\App\Models\Departement::count())
                    return $this->faker->randomElement(\App\Models\Departement::pluck('idDepartement'));
                return \App\Models\Departement::factory()->create()->get()[0]['idDepartement'];
            },
            'specialite'=>$this->faker->word(),
            'echellon'=>$this->faker->word(),
        ];
    }
}
