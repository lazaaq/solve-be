<?php

use App\Question;
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
        $categories = array('Astronomi', 'Biologi', 'Ekonomi', 'Fisika', 'Geografi', 'Kebumian', 'Kimia', 'Komputer', 'Matematika');
        $types = array('Kota/Kabupaten', 'Provinsi', 'Nasional');
        for($i=0; $i<count($categories); $i++) {
            for($j=0; $j<count($types); $j++) {
                for($k=0; $k<5; $k++) {
                    Question::create([
                        'quiz_id' => ($i)*3 + ($j+1),
                        'question' => 'Q' . ($k+1),
                        'pic_url' => '',
                        'created_at' => '2019-12-18 11:23:29',
                        'updated_at' => '2019-12-18 11:23:29',
                        'deleted_at' => NULL,
                    ]);
                }
            }
        }
    }
}