<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('semestre', function(Blueprint $table)
		{
			$table->id('idSemestre');
			$table->integer('idFiliere');
			$table->integer('idModule');
			$table->integer('idAnnee');
			$table->string('nom', 254);

			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('semestre');
	}

}
