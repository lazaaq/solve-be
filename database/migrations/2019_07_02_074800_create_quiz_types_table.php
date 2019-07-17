<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizTypesTable extends Migration {

	public function up()
	{
		Schema::create('quiz_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 40);
			$table->string('description');
			$table->string('pic_url')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('quiz_types');
	}
}
