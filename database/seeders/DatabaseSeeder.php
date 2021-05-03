<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // Truncate all tables, except migrations
        // +++++++++++ START +++++++++++++
        Schema::disableForeignKeyConstraints();
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            if ($table->Tables_in_pfe !== 'migrations')
            DB::table($table->Tables_in_pfe)->truncate();
        }
        Schema::enableForeignKeyConstraints();
        // +++++++++++ END +++++++++++++++=


        \App\Models\Personne::factory(200)->create();
        \App\Models\Anneescolaire::factory(1)->create();
        \App\Models\User::factory(200)->create();
        \App\Models\Profile::factory(200)->create();
        \App\Models\Departement::factory(50)->create();
        \App\Models\Emploi::factory(400)->create();
        \App\Models\Professeur::factory(200)->create();
        \App\Models\Chefdep::factory(50)->create();
        \App\Models\Filiere::factory(200)->create();
        \App\Models\Etudiant::factory(200)->create();
        \App\Models\Semestre::factory(8)->create();
        \App\Models\Module::factory(200)->create();
        \App\Models\Matiere::factory(200)->create();
        \App\Models\Note::factory(200)->create();
        // \App\Models\Notification::factory(200)->create();
        \App\Models\Evenemnt::factory(200)->create();
        \App\Models\Absence::factory(200)->create();

        \App\Models\User::factory()->create([
            'email'=>"amirnet001@gmail.com",
            'password'=>bcrypt('secret'),
            'idPersonne'=> \App\Models\Personne::factory()->create([
                'idPersonne'=>300
                ])->idPersonne
        ]);

        // =======================================

    }


}
