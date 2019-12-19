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
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->after('tot_visible');
            $table->dateTime('waktu_mulai')->after('status');
            $table->dateTime('waktu_selesai')->after('waktu_mulai');
        });
        DB::statement('ALTER TABLE quizs MODIFY COLUMN time time AFTER waktu_selesai');
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
