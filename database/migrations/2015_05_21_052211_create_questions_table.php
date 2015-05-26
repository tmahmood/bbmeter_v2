<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("key", 300);
			$table->unsignedInteger('survey_id');
			$table->foreign('survey_id')
					->references('id')
					->on('surveys')
					->onDelete('cascade');
			$table->unsignedInteger('group_id');
			$table->foreign('group_id')
					->references('id')
					->on('groups')
					->nullable();
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
		Schema::table('questions', function($table) {
			$table->dropForeign('questions_survey_id_foreign');
			$table->dropForeign('questions_group_id_foreign');
		});

		Schema::dropIfExists('questions');
	}
}
