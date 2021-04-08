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
			$table->integer('idPersonne')->nullable()->index('FK_Generalisation_8');
			$table->integer('idFiliere')->nullable()->index('FK_association14');
			$table->integer('idEtudiant')->primary();
			$table->string('cne', 254)->nullable();
			$table->integer('apogee')->nullable();
			$table->dateTime('anneeDuBaccalaureat')->nullable();
			$table->string('cinMere', 254)->nullable();
			$table->string('cinPere', 254)->nullable();
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
