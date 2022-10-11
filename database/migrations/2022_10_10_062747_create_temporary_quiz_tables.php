<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryQuizTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_quiz_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quisz_id');
            $table->string('code');
            $table->string('title');
            $table->string('description');
            $table->integer('sum_question');
            // $table->string('status');
            // $table->string('status_review');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporary_quiz_tables');
    }
}
