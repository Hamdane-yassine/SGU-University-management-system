<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $i = 1;
        return [
            'name' => $this->faker->name,
            // 'email' => $this->faker->unique()->safeEmail,
            'email' => $i.'@1.com',
            // 'email_verified_at' => $this->faker->dateTime(),
            'password' => bcrypt('1'),
            'remember_token' => Str::random(10),
            // 'idPersonne' =>function(){
            //     if(\App\Models\Personne::count()){
            //         $arr = \App\Models\Personne::pluck('idPersonne')->toArray();
            //         return $this->faker->unique()->randomElement($arr);
            //     }
            //     return \App\Models\Personne::factory()->create()->get()[0]['idPersonne'];
            // },
            'idPersonne' => $i++,
            // 'role' => $this->faker->randomElement(['admin','prof','chefdep']),
            'role' => 'null',
        ];
    }
}
