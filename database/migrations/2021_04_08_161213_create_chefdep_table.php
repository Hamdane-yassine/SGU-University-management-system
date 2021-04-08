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
			$table->integer('idDepartement')->nullable()->index('FK_association24');
			$table->integer('idProf')->nullable()->index('FK_Generalisation_15');
			$table->integer('ID_chef')->primary();
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
