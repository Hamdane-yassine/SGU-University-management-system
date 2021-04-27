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
			$table->foreign('idFiliere')->references('idFiliere')->on('filiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idModule')->references('idModule')->on('module')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idAnnee')->references('idAnnee')->on('anneescolaire')->onUpdate('RESTRICT')->onDelete('RESTRICT');

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
			$table->dropForeign('FK_association19');
			$table->dropForeign('FK_association25');
		});
	}

}
