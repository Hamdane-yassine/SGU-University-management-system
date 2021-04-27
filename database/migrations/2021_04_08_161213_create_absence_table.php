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
			$table->bigInteger('idProf')->unsigned();
			$table->bigInteger('idMatier')->unsigned();
			$table->dateTime('dateAbsence');
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
