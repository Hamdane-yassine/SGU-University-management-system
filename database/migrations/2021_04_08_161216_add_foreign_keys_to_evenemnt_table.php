<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEvenemntTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('evenemnt', function(Blueprint $table)
		{
			$table->foreign('ID_chef', 'FK_association22')->references('ID_chef')->on('chefdep')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('evenemnt', function(Blueprint $table)
		{
			$table->dropForeign('FK_association22');
		});
	}

}
