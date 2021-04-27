<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenemntTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evenemnt', function(Blueprint $table)
		{
			$table->id('idEvenemt');
			$table->integer('ID_chef')->references('ID_chef')->on('chefdep');
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
		Schema::drop('evenemnt');
	}

}
