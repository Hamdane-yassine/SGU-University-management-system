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
        static $i =1;
        static $j =201;
        return [
            // 'idUtilisateur' => function (){
            //     if(\App\Models\User::count())
            //         // return $this->faker->randomElement(\App\Models\User::pluck('id'));
            //         return $i++;
            //     return \App\Models\User::factory()->create()->get()[0]['id'];
            // },
            'idUtilisateur' => $i++,
            'idDepartement' => function (){
                if(\App\Models\Departement::count())
                    return $this->faker->randomElement(\App\Models\Departement::pluck('idDepartement'));
                return \App\Models\Departement::factory()->create()->get()[0]['idDepartement'];
            },
            'specialite'=>$this->faker->word(),
            'echellon'=>$this->faker->word(),
            'idEmploi' => $j
        ];
    }
}
