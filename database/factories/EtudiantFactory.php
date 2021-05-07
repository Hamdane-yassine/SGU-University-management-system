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
        static $i = 1;
        return [
            'idPersonne' => function(){
                if(\App\Models\Personne::count())
                    return $this->faker->unique->randomElement(\App\Models\Personne::pluck('idPersonne'));
                return \App\Models\Personne::factory()->create()->get()[0]['idPersonne'];
            },
            'idFiliere' => function(){
                if(\App\Models\Filiere::count())
                    return $this->faker->randomElement(\App\Models\Filiere::pluck('idFiliere'));
                return \App\Models\Filiere::factory()->create()->get()[0]['idFiliere'];
            },
            // 'idFiliere' => $i++,
            'cne'=>$this->faker->unique()->randomNumber(5),
            'apogee'=>$this->faker->unique()->randomDigit(10),
            'email' => $this->faker->unique()->safeEmail,
            'anneeDuBaccalaureat'=>$this->faker->year(),
            'cinMere'=>$this->faker->unique()->randomDigit(),
            'cinPere'=>$this->faker->unique()->randomDigit(),
            'regimeDeCovertureMedicale'=>'oui',
        ];
    }
}
