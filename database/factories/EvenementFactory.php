<?php

namespace Database\Factories;

use App\Models\Evenement;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvenementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evenement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_chef' => function (){
            if(\App\Models\Chefdep::count())
                    return $this->faker->randomElement(\App\Models\Chefdep::pluck('ID_chef'));
            return \App\Models\Chefdep::factory()->create()->get()[0]['ID_chef'];
            },
            'Date_even' => $this->faker->date(),
            'message' => $this->faker->text(),
        ];
    }
}
