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
            'idAnnee' => function (){
                if(\App\Models\Anneescolaire::count())
                    return $this->faker->randomElement(\App\Models\Anneescolaire::pluck('idAnnee'));
                return \App\Models\Anneescolaire::factory()->create()->get()[0]['idAnnee'];
            },
            'nom'=> $this->faker->name(),

        ];
    }
}
