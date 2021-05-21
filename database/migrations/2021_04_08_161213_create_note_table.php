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
			$table->bigInteger('idMatiere')->unsigned();
			$table->float('controle', 10, 0)->nullable();
			$table->float('exam', 10, 0)->nullable();
			$table->float('noteGeneral', 10, 0)->nullable();
			$table->float('noteRatt', 10, 0)->nullable();
			$table->bigInteger('Coefcontrole')->nullable()->default('25');
			$table->bigInteger('Coefexam')->nullable()->default('75');
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
		Schema::drop('note');
	}

}
