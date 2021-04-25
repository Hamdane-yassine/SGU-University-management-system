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
			$table->integer('idSemestre')->primary();
			$table->integer('idFiliere')->nullable()->index('FK_association19');
			$table->integer('idModule')->nullable()->index('FK_association25');
			$table->integer('idAnnee')->nullable()->index('FK_association20');
			$table->string('nom', 254)->nullable();
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
