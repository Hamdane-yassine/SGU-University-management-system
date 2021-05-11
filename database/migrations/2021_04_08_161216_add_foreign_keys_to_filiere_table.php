<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFiliereTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('filiere', function(Blueprint $table)
		{
			$table->foreign('idDepartement','fk13')->references('idDepartement')->on('departement')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('idEmploi','fk130')->references('idEmploi')->on('emploi')->onUpdate('RESTRICT')->onDelete('set null');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('filiere', function(Blueprint $table)
		{
			$table->dropForeign('fk13');
			$table->dropForeign('fk130');
		});
	}

}
