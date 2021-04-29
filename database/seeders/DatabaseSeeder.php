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
        // +++++++++++ END +++++++++++++++=

        \App\Models\User::factory()->create([
            'email'=>"amirnet001@gmail.com",
            'password'=>bcrypt('secret')
        ]);

        \App\Models\Anneescolaire::factory(1)->create();
        \App\Models\Personne::factory(10)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Departement::factory(10)->create();
        \App\Models\Professeur::factory(10)->create();
        \App\Models\Chefdep::factory(10)->create();
        \App\Models\Filiere::factory(10)->create();
        \App\Models\Etudiant::factory(10)->create();
        \App\Models\Module::factory(10)->create();
        \App\Models\Matiere::factory(10)->create();
        \App\Models\Note::factory(10)->create();
        \App\Models\Notification::factory(10)->create();
        \App\Models\Semestre::factory(10)->create();
        \App\Models\Emploi::factory(10)->create();
        \App\Models\Evenemnt::factory(10)->create();
        \App\Models\Absence::factory(10)->create();


        // =======================================

        }


}
