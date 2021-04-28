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

        \App\Models\User::factory()->create();
        // \App\Models\User::factory()->create([
            //         'email' => 'fbed1af31d-199be7@inbox.mailtrap.io'
            // ]);


        // $deparements = (\App\Models\Departement::factory(2)->create()]->get();
        // $profs = (\App\Models\Professeur::factory(2)->create()]->get();
        // $profs = (\App\Models\Professeur::factory(2)->create()]->get();

        // $chef1 = \App\Models\Chefdep::factory()->for($deparements[0])->create();
        // $chef1 = \App\Models\Chefdep::factory()->for($deparements[0]->get()[1])->create();




        // $filieres1 = \App\Models\Filiere::factory(3)->create([
        //     'idDepartement'=>$deparements[0]->get()->idDepartement,
        // ]);

        // $filieres2 = \App\Models\Filiere::factory(3)->create([
        //     'idDepartement'=>$deparements[0]->get()->idDepartement')[1],
        // ]);







        // =======================================

        }


}
