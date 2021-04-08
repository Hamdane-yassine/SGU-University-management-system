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
			$table->foreign('idEtudiant', 'FK_association16')->references('idEtudiant')->on('etudiant')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idMatier', 'FK_association17')->references('idMatier')->on('matiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
			$table->dropForeign('FK_association16');
			$table->dropForeign('FK_association17');
		});
	}

}
