<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizsTable extends Migration {

	public function up()
	{
		Schema::create('quizs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('quiz_type_id')->unsigned();
			$table->string('code')->nullable();
			$table->string('title', 150);
			$table->string('description');
			$table->string('pic_url')->nullable();
			$table->integer('sum_question')->default(0);
			$table->integer('tot_visible')->default(0);
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('quiz_type_id')->references('id')->on('quiz_types');
		});
	}

	public function down()
	{
		Schema::drop('quizs');
	}
}
