<?php

use App\Material;
use App\MaterialMedia;
use App\MaterialModule;
use App\Quiz;
use App\QuizType;
use Illuminate\Database\Seeder;

class MaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizTypes = QuizType::with('quiz')->get();
        $countQuizTypes = count($quizTypes);
        $iteration = 3;

        for($i=0; $i<$countQuizTypes; $i++) {
            for($j=0; $j<$iteration; $j++) {
                $material = Material::create([
                    'quiz_type_id' => $i + 1,
                    'quiz_id' => $quizTypes[$i]['quiz'][$j]['id'],
                    'name' => 'Material name for ' . $quizTypes[$i]['name'] . ($j + 1),
                    'created_by' => '1',
                    'description' => 'Material name for ' . $quizTypes[$i]['description'],
                ]);
                
                MaterialModule::create([
                    'material_id' => $material->id,
                    'name' => 'Module name for ' . $material->name . ($j + 1),
                    'description' => 'Module description for ' . $material->description,
                    'file_url' => 'https://www.figma.com/file/p6X6yb5tiSE6ozQiupig6s/Solve-Web-2',
                ]);
                
                MaterialMedia::create([
                    'material_id' => $material->id,
                    'name' => 'Media name for ' . $material->name . ($j + 1),
                    'description' => 'Media description for ' . $material->description,
                    'video_url' => 'https://youtube.com',
                ]);
            }
        }
    }
}
