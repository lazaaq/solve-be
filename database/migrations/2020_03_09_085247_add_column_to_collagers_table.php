<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToCollagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collagers', function (Blueprint $table) {
            $table->enum('status',['premium','free'])->after('user_id')->default('free');
            $table->dateTime('start_time')->after('status')->nullable();
            $table->dateTime('end_time')->after('start_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collagers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
