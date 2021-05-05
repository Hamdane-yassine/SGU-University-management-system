<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfDepartement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prof_departement', function (Blueprint $table) {
			$table->bigInteger('idProf')->unsigned();
			$table->bigInteger('idDepartement')->unsigned();
            $table->primary(['idProf', 'idDepartement']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prof_departement');
    }
}
