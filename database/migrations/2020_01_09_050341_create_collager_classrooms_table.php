<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollagerClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collager_classrooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('collager_id');
            $table->integer('clasroom_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collager_id')->references('id')->on('collagers');
            $table->foreign('classroom_id')->references('id')->on('classrooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collager_classrooms');
    }
}
