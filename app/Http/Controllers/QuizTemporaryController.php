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
                return responseAPI(200, true, $quizTemporary);
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
                ]);
                return responseAPI(200, true, $newQuizTemporary);
            }
        } catch (Exception $e) {
            return responseAPI(400, false, null, $e);
        }
    }
}
