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
                return \App\Models\Personne::factory()->create()->pluck('idPersonne')[0];
            },
            'idFiliere' => function(){
                return \App\Models\Filiere::factory()->create()->pluck('idFiliere')[0];
            },
        ];
    }
}
