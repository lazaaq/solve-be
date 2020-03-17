<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDataTypeToColumnTimeQuizsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizs', function (Blueprint $table) {
            $table->dropColumn('time');
        });
        Schema::table('quizs', function (Blueprint $table) {
            $table->string('time',10)->after('end_time')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizs', function (Blueprint $table) {
            $table->dropColumn('time');
        });
        Schema::table('quizs', function (Blueprint $table) {
            $table->time('time');
        });
    }
}
