<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('module', function(Blueprint $table)
		{
			$table->foreign('idSemestre', 'FK_association27')->references('idSemestre')->on('semestre')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('module', function(Blueprint $table)
		{
			$table->dropForeign('FK_association27');
		});
	}

}
