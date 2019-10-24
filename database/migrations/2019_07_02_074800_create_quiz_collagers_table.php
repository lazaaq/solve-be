<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizCollagersTable extends Migration {

	public function up()
	{
		Schema::create('quiz_collagers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('quiz_id')->unsigned();
			$table->integer('collager_id')->unsigned();
			$table->integer('total_score');
			$table->timestamps();
			$table->foreign('quiz_id')->references('id')->on('quizs');
			$table->foreign('collager_id')->references('id')->on('collagers');
		});
	}

	public function down()
	{
		Schema::drop('quiz_collagers');
	}
}
