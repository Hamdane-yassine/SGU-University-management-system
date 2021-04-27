<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMatiereTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matiere', function(Blueprint $table)
		{
			$table->foreign('idProf','fk14')->references('idProf')->on('professeur')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idModule','fk15')->references('idModule')->on('module')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matiere', function(Blueprint $table)
		{
			$table->dropForeign('fk14');
			$table->dropForeign('fk15');
		});
	}

}
