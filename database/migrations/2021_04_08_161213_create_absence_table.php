<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('absence', function(Blueprint $table)
		{
			$table->id('IdAbsence');
			$table->integer('idProf')->references('idProf')->on('professeur');
			$table->integer('idMatier')->references('idMatier')->on('matiere');
			$table->dateTime('dateAbsencee');
			$table->string('dateRattrapage');
			$table->enum('etat', [0,1]);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('absence');
	}

}
