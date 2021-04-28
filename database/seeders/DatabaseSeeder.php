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

        // \App\Models\User::factory()->count(2)->create();
        // \App\Models\User::factory()->create([
            //         'email' => 'fbed1af31d-199be7@inbox.mailtrap.io'
            // ]);

        // $deparements = \App\Models\Departement::factory(2)->create();

        // \App\Models\Filiere::factory(3)->for($deparements[0]->get()[0])->create();
        // \App\Models\Filiere::factory(3)->for($deparements[0]->get()[1])->create();

        \App\Models\Absence::factory(3)->create();

        // $filieres = \App\Models\Filiere::factory(3)->create([
        //     'idDepartement'=>$deparements[0]->get()[1]->idDepartement,
        // ]);





        // =======================================

        }


}
