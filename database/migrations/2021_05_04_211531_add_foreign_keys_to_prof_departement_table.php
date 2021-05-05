<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProfDepartementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prof_departement', function (Blueprint $table) {
            $table->foreign('idProf','fk1000')->references('idProf')->on('professeur')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('idDepartement','fk1001')->references('idDepartement')->on('departement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prof_departement', function (Blueprint $table) {
            $table->dropForeign('fk1000');
            $table->dropForeign('fk1001');
        });
    }
}
