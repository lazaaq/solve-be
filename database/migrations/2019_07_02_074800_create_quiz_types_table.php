<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizTypesTable extends Migration {

	public function up()
	{
		Schema::create('quiz_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 40)->default('40');
			$table->string('description', 255)->default('255');
			$table->string('pic_url', 255)->default('255');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('quiz_types');
	}
}