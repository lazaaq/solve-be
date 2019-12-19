<?php

use Illuminate\Database\Seeder;

class QuizCategorysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('quiz_categorys')->delete();
        
        \DB::table('quiz_categorys')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Kategori 1',
                'description' => 'Kategori 1',
                'pic_url' => 'blank.jpg',
                'created_at' => '2019-12-18 11:19:40',
                'updated_at' => '2019-12-18 11:19:40',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}