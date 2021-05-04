<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Evenement', function(Blueprint $table)
		{
			$table->id('idEvenement');
			$table->bigInteger('ID_chef')->unsigned();
			$table->dateTime('Date_even');
			$table->string('message', 254)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Evenement');
	}

}
