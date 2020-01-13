<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToQuizsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizs', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->after('tot_visible');
            $table->dateTime('start_time')->after('status')->nullable();
            $table->dateTime('end_time')->after('start_time')->nullable();
        });
        // DB::statement('ALTER TABLE quizs MODIFY COLUMN time time AFTER end_time');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizs', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('waktu_mulai');
            $table->dropColumn('waktu_selesai');
        });
    }
}
