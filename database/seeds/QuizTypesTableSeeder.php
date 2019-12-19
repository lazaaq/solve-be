<?php

use Illuminate\Database\Seeder;

class QuizTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('quiz_types')->delete();
        
        \DB::table('quiz_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'quiz_category_id' => 1,
                'name' => 'K1 T1',
                'description' => 'K1 T1',
                'pic_url' => 'blank.jpg',
                'created_at' => '2019-12-18 11:19:58',
                'updated_at' => '2019-12-18 11:19:58',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}