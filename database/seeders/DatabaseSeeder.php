<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->count(2)->create();
        // \App\Models\User::factory()->create([
        //         'email' => 'fbed1af31d-199be7@inbox.mailtrap.io'
        // ]);

        // \App\Models\Personne::factory()->has(\App\Models\User::factory()->create())->create();
        // \App\Models\User::factory()->create();
        // \App\Models\Personne::factory()->create();


        // =======================================

        \App\Models\Etudiant::factory()->count(2)->make();
    }
}
