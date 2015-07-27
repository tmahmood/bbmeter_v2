<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SurveyDateEnded extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('surveys', function($table) {
			$table->datetime('date_ended');
			$table->renameColumn('margin_or_error', 'margin_of_error');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('surveys', function($table) {
			$table->dropColumn('date_ended');
			$table->renameColumn('margin_of_error', 'margin_or_error');
		});
	}

}
