<?php

namespace App\Http\Controllers;

use App\QuizTemporary;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class QuizTemporaryController extends Controller
{
    public function store(Request $request) {
        try {
            $quizTemporary = QuizTemporary::where('quiz_id', $request->quiz_id)->where('collager_id', $request->collager_id)->first();
            if ($quizTemporary) {
                $checkDateTime = $this->checkDatetime($quizTemporary->end_time);
                
                if($checkDateTime) {
                    return responseAPI(200, true, $quizTemporary);
                } else {
                    $quizTemporary->delete();
                    $start_time = date('Y-m-d h:i:s', time());

                    $end_time = new DateTime($start_time);
                    $end_time->add(new DateInterval('PT' . $request->duration . 'M'));
                    $end_time = $end_time->format('Y-m-d h:i:s');
                    $newQuizTemporary = QuizTemporary::create([
                        'quiz_id' => $request->quiz_id,
                        'collager_id' => $request->collager_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'answers' => '{}'
                    ]);
                    return responseAPI(200, true, $newQuizTemporary);
                }
            } else {
                $start_time = date('Y-m-d h:i:s', time());

                $end_time = new DateTime($start_time);
                $end_time->add(new DateInterval('PT' . $request->duration . 'M'));
                $end_time = $end_time->format('Y-m-d h:i:s');
                $newQuizTemporary = QuizTemporary::create([
                    'quiz_id' => $request->quiz_id,
                    'collager_id' => $request->collager_id,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'answers' => '{}'
                ]);
                return responseAPI(200, true, $newQuizTemporary);
            }
        } catch (Exception $e) {
            return responseAPI(400, false, null, $e);
        }
    }

    public function storeAnswer(Request $request, $idQuizTemporary) {
        $quizTemporary = QuizTemporary::find($idQuizTemporary);
        $answers = $quizTemporary->answers;
        $answers = json_decode($answers, true);
        $answers[$request->question_id] = $request->answer_id;
        $answers = json_encode($answers);
        $quizTemporary->answers = $answers;
        $quizTemporary->save();
        return responseAPI(200, true, $quizTemporary);
    }

    public function checkDatetime($endTime) {
        $nowDateTime = new DateTime();
        $endDateTime = new DateTime($endTime);
        $checkDateTime = $nowDateTime < $endDateTime;
        return $checkDateTime;
    }
}
