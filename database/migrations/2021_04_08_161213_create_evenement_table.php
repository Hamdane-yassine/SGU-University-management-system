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
			$table->longText('html');
			$table->string('titre', 100);
			$table->string('attachments',256)->nullable();
			$table->string('headingImg',256)->nullable();
			$table->longText('resume');
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
