<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('questions')->delete();
        
        \DB::table('questions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'quiz_id' => 1,
                'question' => 'Q1',
                'pic_url' => '',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'quiz_id' => 1,
                'question' => 'Q2',
                'pic_url' => '',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'quiz_id' => 1,
                'question' => 'Q3',
                'pic_url' => '',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'quiz_id' => 1,
                'question' => 'Q4',
                'pic_url' => '',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'quiz_id' => 1,
                'question' => 'Q5',
                'pic_url' => '',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}