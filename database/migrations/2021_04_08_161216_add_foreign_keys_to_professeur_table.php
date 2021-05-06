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
			$table->foreign('idUtilisateur','fk20')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			// $table->foreign('idDepartement','fk21')->references('idDepartement')->on('departement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idEmploi','fk210')->references('idEmploi')->on('emploi')->onUpdate('RESTRICT')->onDelete('set null');
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
			$table->dropForeign('fk20');
			//$table->dropForeign('fk21');
			$table->dropForeign('fk210');
		});
	}

}
