<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiliereTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filiere', function(Blueprint $table)
		{
			$table->id('idFiliere');
			$table->integer('idDepartement')->references('idDepartement')->on('departement');
			$table->string('nom', 254);
			$table->integer('niveau');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filiere');
	}

}
