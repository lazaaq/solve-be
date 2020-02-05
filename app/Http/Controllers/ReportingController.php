<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\School;
use Excel;

class ReportingController extends Controller
{
    public function reporting($id) {

        $sekolah = School::find($id);
        $user = User::with('collager')->where('school_id', $id)->get();

        return Excel::create('LAPORAN HASIL PENGERJAAN QUIZ '.$sekolah->name, function($excel) use ($user)
        {
            $excel->sheet('Sheet1', function($sheet) use ($user)
            {
                $sheet->freezeFirstRow();
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  12,
                    )
                ));
                $sheet->setAutoSize(array(
                    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'
                ));

                $sheet->cell('A1:I1', function($cell)
                {
                    $cell->setBackground('#FFE699');
                    $cell->setFontWeight('bold');
                });

                $sheet->cell('A1', function($cell)
                {
                    $cell->setValue('NAME');
                });
                $sheet->cell('B1', function($cell)
                {
                    $cell->setValue('SCHOOL');
                });
                $sheet->cell('C1', function($cell)
                {
                    $cell->setValue('DATE');
                });
                $sheet->cell('D1', function($cell)
                {
                    $cell->setValue('CATEGORY');
                });
                $sheet->cell('E1', function($cell)
                {
                    $cell->setValue('TYPE');
                });
                $sheet->cell('F1', function($cell)
                {
                    $cell->setValue('QUIZ');
                });
                $sheet->cell('G1', function($cell)
                {
                    $cell->setValue('TRUE');
                });
                $sheet->cell('H1', function($cell)
                {
                    $cell->setValue('FALSE');
                });
                $sheet->cell('I1', function($cell)
                {
                    $cell->setValue('SCORE');
                });

            foreach ($user as $key => $value) {
                if ($key < 1) {
                    $i = $key+2;
                } else {
                    $i = $i;
                }
                $sheet->cell('A'.$i, $value->name);
                $sheet->cell('B'.$i, $value->school->name);
                foreach (@$value->collager->quizCollager as $key => $value) {
                    $sheet->cell('C'.$i, $value->created_at->format('j F Y'));
                    $sheet->cell('D'.$i, $value->quiz->quizType->quizCategory->name);
                    $sheet->cell('E'.$i, $value->quiz->quizType->name);
                    $sheet->cell('F'.$i, $value->quiz->title);
                    $sheet->cell('G'.$i, strval($value->answerSave->where('isTrue',1)->count()));
                    $sheet->cell('H'.$i, strval($value->answerSave->where('isTrue',0)->count()));
                    $sheet->cell('I'.$i, strval($value->total_score));
                    $i++;
                }
            }           
            });
        })->download('xlsx');
    }
}
