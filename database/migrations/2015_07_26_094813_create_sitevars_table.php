<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitevarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sitevars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("var_name", 20)->unique();
			$table->string("var_value", 300);
			$table->string("var_type", 10);
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
		Schema::drop('sitevars');
	}

}
