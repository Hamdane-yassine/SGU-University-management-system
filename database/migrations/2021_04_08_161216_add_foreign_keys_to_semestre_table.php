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
			$table->foreign('idFiliere','fk22')->references('idFiliere')->on('filiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idModule','fk23')->references('idModule')->on('module')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idAnnee','fk24')->references('idAnnee')->on('anneescolaire')->onUpdate('RESTRICT')->onDelete('RESTRICT');

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
			$table->dropForeign('fk22');
			$table->dropForeign('fk23');
			$table->dropForeign('fk24');
		});
	}

}
