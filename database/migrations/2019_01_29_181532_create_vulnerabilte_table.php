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
			$table->string('description_vulnerabilite', 255);
			$table->string('methodetoutils_vulnerabilite', 255);
			$table->string('impact_vulnerabilite', 255);
			$table->string('solution_vulnerabilite', 255)->nullable();
			$table->smallInteger('probabilite_risk');
			$table->smallInteger('impact_risk');
		});
	}

	public function down()
	{
		Schema::drop('vulnerabilte');
	}
}