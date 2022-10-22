<?php

use App\QuizType;
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
        $categories = array('Astronomi', 'Biologi', 'Ekonomi', 'Fisika', 'Geografi', 'Kebumian', 'Kimia', 'Komputer', 'Matematika');
        $types = array('Kota-Kabupaten', 'Provinsi', 'Nasional');
        for($i=0; $i<count($categories); $i++) {
            for($j=0; $j<count($types); $j++) { // tingkat kota, provinsi, nasional
                QuizType::create([
                    'quiz_category_id' => ($i+1),
                    'name' => $types[$j] . ' ' . $categories[$i],
                    'description' => $types[$j] . ' ' . $categories[$i],
                    'pic_url' => $types[$j] . '.png',
                    'created_by' => 1,
                    'created_at' => '2019-12-18 11:19:58',
                    'updated_at' => '2019-12-18 11:19:58',
                    'deleted_at' => NULL,
                ]);
            }
        }
    }
}