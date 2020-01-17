<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPicUrl2ToQuizCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_categorys', function (Blueprint $table) {
            $table->string('pic_url_2')->after('pic_url')->nullable();
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
            $table->dropColumn('pic_url_2');
        });
    }
}
