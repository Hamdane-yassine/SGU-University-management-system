<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idFiliere' => function (){
                if(\App\Models\Filiere::count())
                    return $this->faker->randomElement(\App\Models\Filiere::pluck('idFiliere'));
                return \App\Models\Filiere::factory()->create()->get()[0]['idFiliere'];
            },
            'idSemestre' => function (){
                if(\App\Models\Semestre::count())
                    return $this->faker->randomElement(\App\Models\Semestre::pluck('idSemestre'));
                return \App\Models\Semestre::factory()->create()->get()[0]['idSemestre'];
            },
            'nom'=> $this->faker->name(),
            'vh'=> $this->faker->randomNumber(),
        ];
    }
}
