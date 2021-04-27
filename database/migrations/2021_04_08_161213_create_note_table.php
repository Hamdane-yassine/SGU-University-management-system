<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('note', function(Blueprint $table)
		{
			$table->id('idNote');
			$table->bigInteger('idEtudiant')->unsigned();
			$table->bigInteger('idMatier')->unsigned();
			$table->float('controle', 10, 0)->nullable();
			$table->float('exam', 10, 0)->nullable();
			$table->float('noteGeneral', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('note');
	}

}
