<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEtudiantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('etudiant', function(Blueprint $table)
		{
			$table->foreign('idPersonne','fk10')->references('idPersonne')->on('personne')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idFiliere','fk11')->references('idFiliere')->on('filiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('etudiant', function(Blueprint $table)
		{
			$table->dropForeign('fk10');
			$table->dropForeign('fk11');
		});
	}

}
