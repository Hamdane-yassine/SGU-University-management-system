<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('module', function (Blueprint $table) {
            $table->foreign('idFiliere','fk22')->references('idFiliere')->on('filiere')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idSemestre','fk23')->references('idSemestre')->on('semestre')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module', function (Blueprint $table) {
            $table->dropForeign('fk22');
			$table->dropForeign('fk23');
        });
    }
}
