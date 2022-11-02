<?php

use App\Answer;

function getScoreQuiz($type) {
    if($type == 'correct') {
        return 4;
    } else if ($type == 'wrong') {
        return -1;
    } else if ($type == 'empty') {
        return 0;
    }
}

function countTotalScore($answersArray) {
    $answersLength = count($answersArray);
    $listOfAnswers = array();
    $rightAnswer = 0;
    $wrongAnswer = 0;
    $emptyAnswer = 0;
    for ($i=0; $i<$answersLength; $i++) {
        if($answersArray[$i]['answered']) {
            array_push($listOfAnswers, $answersArray[$i]['answer_id']);
        } else {
            $emptyAnswer++;
        }
    }
    $answers = Answer::whereIn('id', $listOfAnswers)->get();
    for($i=0; $i<count($answers); $i++) {
        if ($answers[$i]->isTrue) {
            $rightAnswer++;
        } else {
            $wrongAnswer++;
        }
    }
    $totalScore = $rightAnswer * getScoreQuiz('correct') + $wrongAnswer * getScoreQuiz('wrong') + $emptyAnswer * getScoreQuiz('empty');
    return $totalScore;
}