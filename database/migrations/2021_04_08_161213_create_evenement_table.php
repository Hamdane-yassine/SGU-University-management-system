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
			$table->unsignedBigInteger('ID_chef');
			$table->date('date');
			$table->string('html', 2048);
			$table->string('titre', 100);
			$table->string('attachments',256)->nullable();
			$table->string('resume',256);
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
		Schema::drop('Evenement');
	}

}
