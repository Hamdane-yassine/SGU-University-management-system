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
			$table->integer('idDepartement')->nullable()->index('FK_association18');
			$table->integer('idFiliere')->primary();
			$table->string('nom', 254)->nullable();
			$table->integer('niveau')->nullable();
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
