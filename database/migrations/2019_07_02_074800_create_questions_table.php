<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('questions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('quiz_id')->unsigned();
			$table->string('question',255);
			$table->string('pic_url')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('quiz_id')->references('id')->on('quizs');
		});
	}

	public function down()
	{
		Schema::drop('questions');
	}
}
