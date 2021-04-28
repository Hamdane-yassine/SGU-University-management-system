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
                return \App\Models\Etudiant::factory()->create()->pluck('idEtudiant')[0];
            },
            'idMatier'=>function(){
                return \App\Models\Matiere::factory()->create()->pluck('idMatier')[0];
            },
            'controle' => $this->faker->randomFloat,
            'exam' => $this->faker->randomFloat,
            'noteGeneral'=>$this->faker->randomFloat,
        ];
    }
}
