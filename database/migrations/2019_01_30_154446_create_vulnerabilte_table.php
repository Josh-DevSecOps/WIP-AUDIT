<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVulnerabilteTable extends Migration {

	public function up()
	{
		Schema::create('vulnerabilte', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nom_vulnerabilite', 255);
			$table->longText('description_vulnerabilite');
			$table->longText('methodetoutils_vulnerabilite');
			$table->longText('impact_vulnerabilite');
			$table->longText('solution_vulnerabilite')->nullable();
			$table->smallInteger('probabilite_risk');
			$table->smallInteger('impact_risk');
            $table->integer('value_risk_vulnerabilte');
            $table->integer('statusrisk_id')->references('id')
                ->on('statusRisk')
                ->onDelete('restrict')
                ->onUpdate('restrict');
			$table->integer('menace_id')->references('id')->on('menace')
                ->onDelete('restrict')
                ->onUpdate('restrict');
		});
	}

	public function down()
	{
        Schema::table('vulnerabilte', function(Blueprint $table) {
            $table->dropForeign('vulnerabilte_statusrisk_id_foreign');
        });
        Schema::table('vulnerabilte', function(Blueprint $table) {
            $table->dropForeign('vulnerabilte_menace_id_foreign');
        });
		Schema::drop('vulnerabilte');
	}
}