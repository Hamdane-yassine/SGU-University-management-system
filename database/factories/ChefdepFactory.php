<?php

namespace Database\Factories;

use App\Models\Chefdep;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChefdepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chefdep::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $i = 1;
        return [
            // 'idProf' => function (){
            //     if(\App\Models\Professeur::count())
            //         return $this->faker->randomElement(\App\Models\Professeur::pluck('idProf'));
            //     return \App\Models\Professeur::factory()->create()->get()[0]['idProf'];

            // },
            'idProf' => $i++ ,

            'idDepartement' => function (){
                if(\App\Models\Departement::count())
                    return $this->faker->unique()->randomElement(\App\Models\Departement::pluck('idDepartement'));
                return \App\Models\Departement::factory()->create()->get()[0]['idDepartement'];
            }
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Chefdep $chef)
        {
            $chef->professeur->user->role='chefdep';
            $chef->professeur->user->save();
        });
    }
}
