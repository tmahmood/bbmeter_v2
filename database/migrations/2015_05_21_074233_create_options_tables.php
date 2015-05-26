<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('options', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("label", 120);
			$table->decimal("value", 11, 2);
			$table->unsignedInteger('question_id');
			$table->foreign('question_id')
					->references('id')
					->on('questions')
					->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('option_groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("option_group_name", 120);
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
		Schema::table('options', function($table) {
			$table->dropForeign('options_question_id_foreign');
		});
		Schema::dropIfExists('option_groups');
		Schema::dropIfExists('options');
	}
}
