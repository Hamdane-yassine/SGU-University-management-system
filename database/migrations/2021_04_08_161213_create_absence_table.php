<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('absence', function(Blueprint $table)
		{
			$table->integer('idProf')->nullable()->index('FK_association151');
			$table->id('IdAbsence');
			$table->integer('idMatier')->nullable()->index('FK_association152');
			$table->dateTime('dateAbsencee')->nullable();
			$table->string('dateRattrapage')->nullable();
			$table->boolean('etat')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('absence');
	}

}
