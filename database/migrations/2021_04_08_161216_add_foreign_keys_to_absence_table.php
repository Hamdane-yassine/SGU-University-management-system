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
			$table->foreign('idProf')->references('idProf')->on('professeur')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idMatier')->references('idMatier')->on('matiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
			$table->dropForeign('FK_association151');
			$table->dropForeign('FK_association152');
		});
	}

}
