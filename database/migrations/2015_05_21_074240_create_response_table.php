<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('responses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text("label");
			$table->decimal("value", 11, 2);

			$table->unsignedInteger('option_id');
			$table->foreign('option_id')
					->references('id')
					->on('options')
					->onDelete('cascade');

			$table->unsignedInteger('option_group_id');
			$table->foreign('option_group_id')
					->references('id')
					->on('option_groups')
					->onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('responses', function($table) {
			$table->dropForeign('responses_option_id_foreign');
			$table->dropForeign('responses_option_group_id_foreign');
		});
		Schema::dropIfExists('responses');
	}

}
