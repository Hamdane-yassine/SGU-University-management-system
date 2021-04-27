<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesseurTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('professeur', function(Blueprint $table)
		{
			$table->id('idProf');
			$table->bigInteger('idUtilisateur')->unsigned();
			$table->bigInteger('idDepartement')->unsigned();
			$table->string('specialite', 254);
			$table->string('echellon', 254);


		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('professeur');
	}

}
