<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idEtudiant'=>function(){
                if(\App\Models\Etudiant::count())
                    return $this->faker->randomElement(\App\Models\Etudiant::pluck('idEtudiant'));
                return \App\Models\Etudiant::factory()->create()->get()[0]['idEtudiant'];
            },
            'idMatier'=>function(){
                if(\App\Models\Matiere::count())
                    return $this->faker->randomElement(\App\Models\Matiere::pluck('idMatier'));
                return \App\Models\Matiere::factory()->create()->get()[0]['idMatier'];
            },
            'controle' => $this->faker->randomFloat,
            'exam' => $this->faker->randomFloat,
            'noteGeneral'=>$this->faker->randomFloat,
        ];
    }
}
