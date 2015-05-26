<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('survey_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("survey_type_name", 120);
			$table->timestamps();
		});

		Schema::create('surveys', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("survey_name", 120)->unique();
			$table->unsignedInteger("participants");
			$table->decimal('margin_or_error', 4, 2);
			$table->datetime("survey_date");
			$table->unsignedInteger('survey_type_id');
			$table->foreign('survey_type_id')
					->references('id')
					->on('survey_types')
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
		Schema::table('surveys', function($table) {
			$table->dropForeign('surveys_survey_type_id_foreign');
		});

		Schema::dropIfExists('surveys');
		Schema::dropIfExists('survey_types');
	}

}
