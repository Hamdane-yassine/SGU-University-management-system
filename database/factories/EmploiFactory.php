<?php

namespace Database\Factories;

use App\Models\Emploi;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emploi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idProf' => function() {
                if(\App\Models\Professeur::count())
                    return $this->faker->randomElement(\App\Models\Professeur::pluck('idProf'));
                return \App\Models\Professeur::factory()->create()->get()[0]['idProf'];
            },
        ];
    }
}
