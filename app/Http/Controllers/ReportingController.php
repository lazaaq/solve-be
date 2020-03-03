<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\School;
use App\Quiz;
use App\QuizCollager;
use Auth;
use Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;

class ReportingController extends Controller
{
    public function reporting($id) {

        $sekolah = School::find($id);
        $user = User::with('collager')->where('school_id', $id)->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $header = ['NAME','SCHOOL','DATE','CATEGORY','TYPE','QUIZ','TRUE','FALSE','SCORE'];
        $sheet->fromArray($header, NULL, 'A1');
        foreach ($user as $key => $value) {
            if ($key < 1) {
                $i = $key+2;
            } else {
                $i = $i;
            }
            $sheet->setCellValue('A'.$i, $value->name);
            $sheet->setCellValue('B'.$i, $value->school->name);
            foreach (@$value->collager->quizCollager as $key => $value) {
                $sheet->setCellValue('C'.$i, $value->created_at->format('j F Y'));
                $sheet->setCellValue('D'.$i, $value->quiz->quizType->quizCategory->name);
                $sheet->setCellValue('E'.$i, $value->quiz->quizType->name);
                $sheet->setCellValue('F'.$i, $value->quiz->title);
                $sheet->setCellValue('G'.$i, $value->answerSave->where('isTrue',1)->count());
                $sheet->setCellValue('H'.$i, $value->answerSave->where('isTrue',0)->count());
                $sheet->setCellValue('I'.$i, $value->total_score);
                $i++;
            }
        }

        foreach(range('A','I') as $columnID) {
            $sheet = $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFE699');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="LAPORAN HASIL PENGERJAAN QUIZ '.$sekolah->name.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function reportingQuiz($id) {
        $quiz = Quiz::find($id);
        if (Auth::user()->hasRole('admin')) { 
            $user = User::whereHas('roles', function($q) { $q->where('name', 'student'); })->get();
        } else {
            $sekolah = Auth::user()->school_id;
            $user = User::with('collager')->where('school_id', $sekolah)->get();
        }
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $header = ['NAME','SCHOOL','DATE','CATEGORY','TYPE','QUIZ','TRUE','FALSE','SCORE'];
        $sheet->fromArray($header, NULL, 'A1');

        foreach ($user as $key => $value) {
            if ($key < 1) {
                $i = $key+2;
            } else {
                $i = $i;
            }
            $sheet->setCellValue('A'.$i, $value->name);
            $sheet->setCellValue('B'.$i, $value->school->name);
            foreach (@$value->collager->quizCollager->where('quiz_id', $id) as $key => $value) {
                $sheet->setCellValue('C'.$i, $value->created_at->format('j F Y'));
                $sheet->setCellValue('D'.$i, $value->quiz->quizType->quizCategory->name);
                $sheet->setCellValue('E'.$i, $value->quiz->quizType->name);
                $sheet->setCellValue('F'.$i, $value->quiz->title);
                $sheet->setCellValue('G'.$i, $value->answerSave->where('isTrue',1)->count());
                $sheet->setCellValue('H'.$i, $value->answerSave->where('isTrue',0)->count());
                $sheet->setCellValue('I'.$i, $value->total_score);
                $i++;
            }
        }

        foreach(range('A','I') as $columnID) {
            $sheet = $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFE699');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="LAPORAN HASIL PENGERJAAN QUIZ'.$quiz->title.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
