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
                $endTime = explode(" ", $quizTemporary->end_time);
                $duration = $this->getDuration($endTime[1]);
                
                if($duration > 0) {
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
                ]);
                return responseAPI(200, true, $newQuizTemporary);
            }
        } catch (Exception $e) {
            return responseAPI(400, false, null, $e);
        }
    }

    public function getDuration($endTime) {
        $nowTime = date("H:i:s");
        $array1 = explode(':', $nowTime);
        $array2 = explode(':', $endTime);

        $duration1 = ($array1[0] * 3600.0 + $array1[1] * 60 + $array1[2]);
        $duration2 = ($array2[0] * 3600.0 + $array2[1] * 60 + $array2[2]);

        $duration = $duration2 - $duration1;
        return $duration;
    }
}
