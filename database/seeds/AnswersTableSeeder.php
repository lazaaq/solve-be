<?php

use App\Answer;
use App\Question;
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
        $questions = Question::all();
        $option = array('A', 'B', 'C', 'D', 'E');
        for($i=1; $i<=$questions->count(); $i++) {
            $random1 = rand(1,5);
            for($j=0; $j<$random1; $j++) {
                Answer::create([
                    'question_id' => $i,
                    'option' => $option[$j],
                    'content' => 'A' . $i . ' ' . $option[$j],
                    'pic_url' => '',
                    'isTrue' => $j == 0 ? '1' : '0',
                    'created_at' => '2019-12-18 11:23:29',
                    'updated_at' => '2019-12-18 11:23:29',
                    'deleted_at' => NULL,
                ]);
            }
        }
    }
}