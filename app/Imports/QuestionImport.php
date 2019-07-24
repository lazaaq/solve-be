<?php

namespace App\Imports;

use App\Question;
use App\Quiz;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class QuestionImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  __construct($quiz)
    {
        $this->quiz_id = $quiz;
    }

    public function collection(Collection $rows)
    {
        $question = [];
        $answers = [];
        $option = ['A', 'B', 'C', 'D', 'E'];

        foreach ($rows as $key => $row) {
            if ($key === 0 || $key === 1  || $key === 2 || $key === 3 || $key === 4) {
                continue;
            }
            
            $question[$key] = [
                'quiz_id'       => $this->quiz_id,
                'question'      => $row['QUESTION'],
            ];
            
            $content = [$row['OPTION A'],$row['OPTION B'],$row['OPTION C'],$row['OPTION D'],$row['OPTION E']];

            for ($i=0; $i < 5 ; $i++) { 
                $answers[$key][$i] = [
                    'option'  => $option[$i],
                    'content' => $content[$i],
                    'isTrue'  => $row['TRUE ANSWER'] == $option[$i] ? 1 : 0,
                ];
            }
            
        }

        foreach ($question as $key => $q) {
            Question::create($q)->answer()->createMany($answers[$key]);
        }
    }

}
