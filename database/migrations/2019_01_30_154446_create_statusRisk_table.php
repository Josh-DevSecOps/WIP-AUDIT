<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatusRiskTable extends Migration {

	public function up()
	{
		Schema::create('statusRisk', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('libelle', 255);
			$table->string('valeur',255);
            $table->string('consequence',254);
            $table->longText('actions');


        });
	}

	public function down()
	{
		Schema::drop('statusRisk');
	}
}