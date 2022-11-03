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
            $start_time = date('Y-m-d h:i:s', time());

            $end_time = new DateTime($start_time);
            $end_time->add(new DateInterval('PT' . $request->duration . 'M'));
            $end_time = $end_time->format('Y-m-d h:i:s');
            $quiz_temporary = QuizTemporary::create([
                'quiz_id' => $request->quiz_id,
                'collager_id' => $request->collager_id,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);

            return responseAPI(200, true, $quiz_temporary);
        } catch (Exception $e) {
            return responseAPI(400, false, null, $e);
        }
    }
}
