<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProtocoleTable extends Migration {

	public function up()
	{
		Schema::create('protocole', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nom_protocole', 255);
			$table->longText('description_protocole');
		});
	}

	public function down()
	{
		Schema::drop('protocole');
	}
}