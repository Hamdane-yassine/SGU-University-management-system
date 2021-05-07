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
            'cne'=> $this->faker->randomLetter.$this->faker->unique->randomNumber(5),
            'apogee'=>$this->withFaker()->unique()->randomNumber(5),
            'email' => $this->faker->email,
            'anneeDuBaccalaureat'=>$this->faker->year(),
            'cinMere'=>$this->faker->randomLetter.$this->faker->randomNumber(5),
            'cinPere'=>$this->faker->randomLetter.$this->faker->randomNumber(5),
            'regimeDeCovertureMedicale'=>'oui',
        ];
    }
}
