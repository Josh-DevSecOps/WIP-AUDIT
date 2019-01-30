<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('menace', function(Blueprint $table) {
			$table->foreign('protocole_id')->references('id')->on('protocole')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('vulnerabilte', function(Blueprint $table) {
			$table->foreign('statusrisk_id')->references('id')->on('statusRisk')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('vulnerabilte', function(Blueprint $table) {
			$table->foreign('menace_id')->references('id')->on('menace')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('menace', function(Blueprint $table) {
			$table->dropForeign('menace_protocole_id_foreign');
		});
		Schema::table('vulnerabilte', function(Blueprint $table) {
			$table->dropForeign('vulnerabilte_statusrisk_id_foreign');
		});
		Schema::table('vulnerabilte', function(Blueprint $table) {
			$table->dropForeign('vulnerabilte_menace_id_foreign');
		});
	}
}