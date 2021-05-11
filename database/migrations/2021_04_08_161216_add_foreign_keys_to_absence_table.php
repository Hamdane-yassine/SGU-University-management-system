<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAbsenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('absence', function(Blueprint $table)
		{
			$table->foreign('idProf','fk1')->references('idProf')->on('professeur')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('idMatiere','fk2')->references('idMatiere')->on('matiere')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('absence', function(Blueprint $table)
		{
			$table->dropForeign('fk1');
			$table->dropForeign('fk2');
		});
	}

}
