<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizsTable extends Migration {

	public function up()
	{
		Schema::create('quizs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('quiz_type_id');
			$table->integer('time_id');
			$table->string('title', 40)->default('40');
			$table->string('description');
			$table->string('pic_url', 255)->default('255');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('quizs');
	}
}