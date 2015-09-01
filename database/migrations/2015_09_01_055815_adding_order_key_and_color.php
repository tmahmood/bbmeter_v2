<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingOrderKeyAndColor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('questions', function($table) {
			$table->string("colors", 300);
			$table->unsignedInteger("ordering");
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('questions', function($table) {
			$table->dropColumn('colors');
			$table->dropColumn('ordering');
		});
	}

}
