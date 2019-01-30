<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenaceTable extends Migration {

	public function up()
	{
		Schema::create('menace', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nom_menace', 255);
			$table->string('description_menace', 255);
			$table->string('solution_menace', 255);
			$table->integer('protocole_id')
                ->references('id')->on('protocole')
                ->onDelete('restrict')
                ->onUpdate('restrict');
		});
	}

	public function down()
	{
        Schema::table('menace', function(Blueprint $table) {
            $table->dropForeign('menace_protocole_id_foreign');
        });
		Schema::drop('menace');
	}
}