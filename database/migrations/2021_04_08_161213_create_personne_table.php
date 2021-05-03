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
			$table->id('idPersonne');
			$table->string('nom', 254);
			$table->string('prenom', 254);
			$table->string('adressePersonnele', 254);
			$table->string('cin', 254);
			$table->string('email', 254);
			$table->string('tel', 254);
			$table->date('dateNaissance');
			$table->string('nationalite', 254);
			$table->String('lieuNaissance');
			$table->enum('genre', ['Masculin', 'Féminin']);
			$table->string('emailInstitutionne', 254);
			$table->enum('situationFamiliale', ['Célibataire', 'Divorcé','Marié']);
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
