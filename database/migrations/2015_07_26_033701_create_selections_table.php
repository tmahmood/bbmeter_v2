<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('selections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('question_id');
			$table->foreign('question_id')
					->references('id')
					->on('questions');
			$table->string("visible_at", 30);
			$table->unsignedInteger("is_unique");
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
		Schema::drop('selections');
	}
}
