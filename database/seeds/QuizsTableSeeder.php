<?php

use Illuminate\Database\Seeder;

class QuizsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('quizs')->delete();
        
        \DB::table('quizs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'quiz_type_id' => 1,
                'code' => '6023E',
                'title' => 'K1 T1 Q1',
                'description' => 'K1 T1 Q1',
                'pic_url' => 'blank.jpg',
                'sum_question' => 5,
                'tot_visible' => 5,
                'created_at' => '2019-12-18 11:20:37',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
                'time' => '01:00:00',
            ),
        ));
        
        
    }
}