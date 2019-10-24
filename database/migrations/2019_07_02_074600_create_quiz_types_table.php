<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizTypesTable extends Migration {

	public function up()
	{
		Schema::create('quiz_types', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('quiz_category_id')->unsigned();
			$table->string('name', 150);
			$table->string('description');
			$table->string('pic_url')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('quiz_category_id')->references('id')->on('quiz_categorys');
		});
	}

	public function down()
	{
		Schema::drop('quiz_types');
	}
}
