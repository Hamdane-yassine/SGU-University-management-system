<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('note', function(Blueprint $table)
		{
			$table->foreign('idEtudiant','fk16')->references('idProf')->on('professeur')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idMatier','fk17')->references('idMatier')->on('matiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('note', function(Blueprint $table)
		{
			$table->dropForeign('fk16');
			$table->dropForeign('fk17');
		});
	}

}
