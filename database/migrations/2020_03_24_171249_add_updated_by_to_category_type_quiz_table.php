<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedByToCategoryTypeQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_categorys', function (Blueprint $table) {
            $table->integer('updated_by')->nullable()->after('created_by');
        });
        Schema::table('quiz_types', function (Blueprint $table) {
            $table->integer('updated_by')->nullable()->after('created_by');
        });
        Schema::table('quizs', function (Blueprint $table) {
            $table->integer('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_categorys', function (Blueprint $table) {
            $table->dropColumn('updated_by');
        });
        Schema::table('quiz_types', function (Blueprint $table) {
            $table->dropColumn('updated_by');
        });
        Schema::table('quizs', function (Blueprint $table) {
            $table->dropColumn('updated_by');
        });
    }
}
