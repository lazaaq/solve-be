<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('questions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('quiz_id');
			$table->string('question');
			$table->string('pic_url');
			$table->string('choice1');
			$table->string('choice2');
			$table->string('choice3');
			$table->string('choice4');
			$table->string('choice5');
			$table->string('isRight');
			$table->string('scoreRight');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('questions');
	}
}