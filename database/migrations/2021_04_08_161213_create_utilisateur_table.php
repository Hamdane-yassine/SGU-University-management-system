<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateurTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utilisateur', function(Blueprint $table)
		{
			$table->integer('idPersonne')->nullable()->index('FK_Generalisation_7');
			$table->integer('idUtilisateur')->primary();
			$table->string('nomUtilisateur', 254)->nullable();
			$table->string('motDePass', 254)->nullable();
			$table->string('role', 254)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('utilisateur');
	}

}
