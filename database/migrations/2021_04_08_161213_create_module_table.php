<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('module', function(Blueprint $table)
		{
			$table->integer('idSemestre')->nullable()->index('FK_association27');
			$table->integer('idModule')->primary();
			$table->string('nom', 254)->nullable();
			$table->integer('vh')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('module');
	}

}
