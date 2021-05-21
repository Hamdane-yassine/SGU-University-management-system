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
			$table->bigInteger('idDepartement')->unsigned();
			$table->string('nom', 254);
			$table->string('shortcut', 45);
			$table->string('diplome', 254);
			$table->integer('niveau');
            $table->bigInteger('idEmploi')->unsigned()->nullable();
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
		Schema::drop('filiere');
	}

}
