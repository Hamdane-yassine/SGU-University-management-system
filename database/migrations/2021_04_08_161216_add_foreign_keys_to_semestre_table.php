<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSemestreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('semestre', function(Blueprint $table)
		{
			$table->foreign('idAnnee','fk24')->references('idAnnee')->on('anneescolaire')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idFiliere','fk25')->references('idFiliere')->on('filiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('semestre', function(Blueprint $table)
		{
	
			$table->dropForeign('fk24');
			$table->dropForeign('fk25');
		});
	}

}
