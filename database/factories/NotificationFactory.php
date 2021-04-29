<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idUtilisateur' => function (){
                if(\App\Models\User::count())
                    return $this->faker->randomElement(\App\Models\User::pluck('id'));
                return \App\Models\User::factory()->create()->get()[0]['id'];
            },
            'message'=> $this->faker->text(),
        ];
    }
}
