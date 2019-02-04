<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExperienceTable extends Migration {

	public function up()
	{
		Schema::create('Experience', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('description', 255);
		});
	}

	public function down()
	{
		Schema::drop('Experience');
	}
}