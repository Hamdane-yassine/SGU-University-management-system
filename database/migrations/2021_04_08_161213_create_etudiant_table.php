<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('etudiant', function(Blueprint $table)
		{
			$table->id('idEtudiant');
			$table->bigInteger('idPersonne')->unsigned();
			$table->bigInteger('idFiliere')->unsigned();
			$table->string('cne', 254);
			$table->integer('apogee');
			$table->dateTime('anneeDuBaccalaureat');
			$table->string('cinMere', 254);
			$table->string('cinPere', 254);
			$table->string('regimeDeCovertureMedicale', 254)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etudiant');
	}

}
