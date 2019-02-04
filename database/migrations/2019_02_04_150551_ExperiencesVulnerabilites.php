<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExperiencesVulnerabilites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencesvulnerabilites',function (Blueprint $table)
        {
            $table->increments('id');
          //  $table->timestamp();
            $table->integer('experiences_id')->unsigned();
            $table->integer('vulnerabiltes_id')->unsigned();

            $table->foreign('experiences_id')
                   ->references('id')
                  ->on('Experience')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('vulnerabiltes_id')
                ->references('id')
                ->on('vulnerabilte')
                ->onDelete('restrict')
                ->onUpdate('restrict');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experiencesvulnerabilites', function(Blueprint $table) {
            $table->dropForeign('experiencesvulnerabilites_experiences_id_foreign');
        });
        Schema::table('experiencesvulnerabilites', function(Blueprint $table) {
            $table->dropForeign('experiencesvulnerabilites_vulnerabiltes_id_foreign');
        });

        Schema::drop('experiencesvulnerabilites');
    }
}
