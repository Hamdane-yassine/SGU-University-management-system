<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInsertionNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insertionNotes', function(Blueprint $table)
		{
			$table->foreign('idFiliere','fk300')->references('idFiliere')->on('filiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insertionNotes', function(Blueprint $table)
		{
			$table->dropForeign('fk300');
		});

    }
}
