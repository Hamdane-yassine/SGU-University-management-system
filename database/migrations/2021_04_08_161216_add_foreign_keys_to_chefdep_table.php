<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToChefdepTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chefdep', function(Blueprint $table)
		{
			$table->foreign('idProf', 'FK_Generalisation_15')->references('idProf')->on('professeur')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idDepartement', 'FK_association24')->references('idDepartement')->on('departement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('chefdep', function(Blueprint $table)
		{
			$table->dropForeign('FK_Generalisation_15');
			$table->dropForeign('FK_association24');
		});
	}

}
