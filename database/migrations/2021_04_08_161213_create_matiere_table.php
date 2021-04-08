<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatiereTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matiere', function(Blueprint $table)
		{
			$table->integer('idProf')->nullable()->index('FK_association10');
			$table->integer('idMatier')->primary();
			$table->integer('idModule')->nullable()->index('FK_association28');
			$table->string('nom', 254)->nullable();
			$table->integer('vh')->nullable();
			$table->integer('coeff')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matiere');
	}

}
