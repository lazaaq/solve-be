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
        for($i=0; $i<$countQuizTypes; $i++) {
            $material = Material::create([
                'quiz_type_id' => $i,
                'quiz_id' => $quizTypes[$i]['quiz'][0]['id'],
                'name' => 'Material name for ' . $quizTypes[$i]['name'],
                'description' => 'Material name for ' . $quizTypes[$i]['description'],
            ]);

            MaterialModule::create([
                'material_id' => $material->id,
                'name' => 'Module name for ' . $material->name,
                'description' => 'Module description for ' . $material->description,
                'file_url' => 'https://www.figma.com/file/p6X6yb5tiSE6ozQiupig6s/Solve-Web-2',
            ]);

            MaterialMedia::create([
                'material_id' => $material->id,
                'name' => 'Media name for ' . $material->name,
                'description' => 'Media description for ' . $material->description,
                'video_url' => 'https://youtube.com',
            ]);
        }
    }
}
