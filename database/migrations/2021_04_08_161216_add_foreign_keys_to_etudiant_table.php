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
			$table->foreign('idPersonne')->references('idPersonne')->on('idPersonne')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idFiliere')->references('idFiliere')->on('filiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
			$table->dropForeign('FK_Generalisation_8');
			$table->dropForeign('FK_association14');
		});
	}

}
