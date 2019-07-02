<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswerSavesTable extends Migration {

	public function up()
	{
		Schema::create('answer_saves', function(Blueprint $table) {
			$table->increments('id');
			$table->string('collager_id');
			$table->string('question_id');
			$table->string('collager_answer');
			$table->string('score');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('answer_saves');
	}
}