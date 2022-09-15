<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialChapterModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_chapter_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_chapter_id');
            $table->string('name');
            $table->string('description');
            $table->string('file_url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_chapter_modules');
    }
}
