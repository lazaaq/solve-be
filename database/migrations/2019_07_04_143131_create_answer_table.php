<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('answers', function(Blueprint $table) {
        $table->bigIncrements('id');
        $table->integer('question_id')->unsigned();
        $table->string('option');
        $table->string('content')->nullable();
        $table->string('pic_url')->nullable();
        $table->string('isTrue',1);
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('question_id')->references('id')->on('questions');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer');
    }
}
