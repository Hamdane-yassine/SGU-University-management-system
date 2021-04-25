<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProfesseurTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('professeur', function(Blueprint $table)
		{
			$table->foreign('idUtilisateur', 'FK_Generalisation_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idDepartement', 'FK_association26')->references('idDepartement')->on('departement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('professeur', function(Blueprint $table)
		{
			$table->dropForeign('FK_Generalisation_4');
			$table->dropForeign('FK_association26');
		});
	}

}
