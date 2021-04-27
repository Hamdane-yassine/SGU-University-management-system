<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChefdepTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chefdep', function(Blueprint $table)
		{
			$table->id('ID_chef');
			$table->integer('idDepartement')->references('idDepartement')->on('departement');
			$table->integer('idProf')->references('idProf')->on('professeur');
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chefdep');
	}

}
