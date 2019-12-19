<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('answers')->delete();
        
        \DB::table('answers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'question_id' => 1,
                'option' => 'A',
                'content' => 'Q1 A',
                'pic_url' => '',
                'isTrue' => '1',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'question_id' => 1,
                'option' => 'B',
                'content' => 'Q1 B',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'question_id' => 2,
                'option' => 'A',
                'content' => 'Q2 A',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'question_id' => 2,
                'option' => 'B',
                'content' => 'Q2 B',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'question_id' => 2,
                'option' => 'C',
                'content' => 'Q2 C',
                'pic_url' => '',
                'isTrue' => '1',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'question_id' => 2,
                'option' => 'D',
                'content' => 'Q2 D',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:29',
                'updated_at' => '2019-12-18 11:23:29',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'question_id' => 3,
                'option' => 'A',
                'content' => 'Q3 A',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'question_id' => 3,
                'option' => 'B',
                'content' => 'Q3 B',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'question_id' => 3,
                'option' => 'C',
                'content' => 'Q3 C',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'question_id' => 3,
                'option' => 'D',
                'content' => 'Q3 D',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'question_id' => 3,
                'option' => 'E',
                'content' => 'Q3 E',
                'pic_url' => '',
                'isTrue' => '1',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'question_id' => 4,
                'option' => 'A',
                'content' => 'Q4 A',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'question_id' => 4,
                'option' => 'B',
                'content' => 'Q4 B',
                'pic_url' => '',
                'isTrue' => '1',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'question_id' => 4,
                'option' => 'C',
                'content' => 'Q4 C',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'question_id' => 5,
                'option' => 'A',
                'content' => 'Q5 A',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'question_id' => 5,
                'option' => 'B',
                'content' => 'Q5 B',
                'pic_url' => '',
                'isTrue' => '0',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'question_id' => 5,
                'option' => 'C',
                'content' => 'Q5 C',
                'pic_url' => '',
                'isTrue' => '1',
                'created_at' => '2019-12-18 11:23:30',
                'updated_at' => '2019-12-18 11:23:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}