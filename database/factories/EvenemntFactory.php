<?php

namespace Database\Factories;

use App\Models\Evenemnt;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvenemntFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evenemnt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_chef' => function (){
              return \App\Models\Chefdep::factory()->create()->get()[0]['ID_chef'];
            },
            'Date_even' => $this->faker->date(),
            'message' => $this->faker->paragraph(),
        ];
    }
}
