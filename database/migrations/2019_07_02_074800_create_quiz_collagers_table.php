<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizCollagersTable extends Migration {

	public function up()
	{
		Schema::create('quiz_collagers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('quiz_id');
			$table->integer('collager_id');
			$table->integer('total_score');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('quiz_collagers');
	}
}
