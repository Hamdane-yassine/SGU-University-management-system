<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personne', function(Blueprint $table)
		{
			$table->integer('idPersonne')->primary();
			$table->string('nom', 254)->nullable();
			$table->string('prenom', 254)->nullable();
			$table->string('adressePersonnele', 254)->nullable();
			$table->string('cin', 254)->nullable();
			$table->string('email', 254)->nullable();
			$table->string('tel', 254)->nullable();
			$table->dateTime('dateNaissance')->nullable();
			$table->string('nationalite', 254)->nullable();
			$table->dateTime('lieuNaissance')->nullable();
			$table->string('genre', 254)->nullable();
			$table->string('emailInstitutionne', 254)->nullable();
			$table->string('situationFamiliale', 254)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('personne');
	}

}
