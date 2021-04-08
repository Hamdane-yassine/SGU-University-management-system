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
			$table->integer('idUtilisateur')->nullable()->index('FK_Generalisation_4');
			$table->integer('idDepartement')->nullable()->index('FK_association26');
			$table->integer('idProf')->primary();
			$table->string('specialite', 254)->nullable();
			$table->string('echellon', 254)->nullable();
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
