<?php

use Illuminate\Database\Seeder;

class QuizTemporaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = array('Astronomi', 'Biologi', 'Ekonomi', 'Fisika', 'Geografi', 'Kebumian', 'Kimia', 'Komputer', 'Matematika');
        $types = array('Kota/Kabupaten', 'Provinsi', 'Nasional');
        for($i=0; $i<count($categories); $i++) {
            for($j=0; $j<count($types); $j++) {
                Quiz::create([
                    'id' => ($i)*3 + ($j+1),
                    'quisz_id' => ($i)*3 + ($j+1),
                    'code' => 'CODE',
                    'title' => $types[$j] . ' ' . $categories[$i],
                    'description' => $types[$j] . ' ' . $categories[$i],
                    'sum_question' => 5,
                    'start_time' => '2019-12-01 00:00:00',
                    'end_time' => '2024-12-31 23:59:00',
                    'time' => 30,
                    'created_at' => '2019-12-18 11:20:37',
                    'updated_at' => '2019-12-20 06:17:22',
                    'deleted_at' => NULL,
                ]);
            }
        }
    }
}
