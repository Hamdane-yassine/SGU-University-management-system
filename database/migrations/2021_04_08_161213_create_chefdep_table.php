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
			$table->bigInteger('idDepartement')->unsigned();
			$table->bigInteger('idProf')->unsigned();
            $table->timestamps();
			
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
