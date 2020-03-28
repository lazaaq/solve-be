<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Collager;
use App\QuizCollager;
use App\Quiz;
use App\Question;
use App\AnswerSave;
use DataTables;
use Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('history.index');
    }

    public function getData()
    {
        if (Auth::user()->hasRole('admin')) {
            $data = User::role('student')->get()->sortBy('name');
        } else {
            $data = User::role('student')->where('school_id',Auth::user()->school_id)->get()->sortBy('name');
        }
        return datatables()->of($data)
        ->addColumn('school', function($row){
            if ($row->school) {
              return $row->school->name;
            }else {
              return '-';
            }
        })
        ->addColumn('action', function($row){
          $btn = '<a id="btn-detail" href="'.route('history.show',$row->id).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-eye"></i></a>';
          return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function getDataHistoryUser($id)
    {
        $collager_id = Collager::where('user_id',$id)->first()->id;
        $data = QuizCollager::where('collager_id',$collager_id)->get();
        //return $data;
        return datatables()->of($data)->addColumn('action', function($row){
        $btn = '<a id="btn-detail" href="'.route('detailHistory',$row->id).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-eye"></i></a>';
        return $btn;
        })
        ->rawColumns(['action'])
        ->addColumn('category', function($row){
            return $row->quiz->quizType->quizCategory->name;
        })
        ->addColumn('type', function($row){
            return $row->quiz->quizType->name;
        })
        ->addColumn('title', function($row){
            return $row->quiz->title;
        })
        ->addColumn('date', function($row){
            return $row->created_at->format('j F Y');;
        })
        ->addColumn('score', function($row){
            return $row->total_score;
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        return view('history.history-user',compact('data'));
    }

    public function getDataChartUser($id)
    {
        $collager_id = Collager::where('user_id',$id)->first()->id;
        $chart = QuizCollager::with('quiz')->where('collager_id',$collager_id)->get();
        $chart = $chart->groupBy('quiz.title');
        $result = [];

        foreach ($chart as $key => $value) {
            $result[$key][] = $key;
            foreach ($value as $key1 => $value1) {
                $result[$key][] = $value1->total_score;
            }

        }
        $result = array_values($result);

        foreach ($result as $key => $value) {
            foreach ($value as $key1 => $value1) {
                if ($key1 == 0) {
                    $number[] = "x";
                } else {
                    $number[] = $key1;
                }
            }
        }
        $number = array_combine($number,$number);
        $number = array_values($number);
        array_unshift($result , $number);

        // dd(json_encode($result));
        return response()->json($result);
    }

    public function detailHistory($id)
    {
        $quiz = Quiz::where('id', QuizCollager::find($id)->quiz_id)->first();
        $user = QuizCollager::find($id)->collager->user->id;
        $data = AnswerSave::where('quiz_collager_id',$id)->paginate(10);
        // $data = Question::where('quiz_id', $quiz->id)->paginate(10);
        // dd($data);
        $number = $data->firstItem();
        return view('history.view', compact('quiz','number','user','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // START OF API

    public function api_index()
    {
        $collager_id = Auth::user()->collager->id;
        $data = QuizCollager::where('collager_id',$collager_id)->with('quiz.quizType.quizCategory')->orderBy('created_at','DESC')->get();
        foreach ($data as $key => $value) {
          $data[$key]->true_sum = $data[$key]->answerSave()->where('isTrue', 1)->count();
          $data[$key]->false_sum = $data[$key]->answerSave()->where('isTrue', 0)->count();
        }
        return response()->json([
            'status' => 'success',
            'result'   => $data
        ]);
    }

    public function api_detailHistory($quiz_collager_id)
    {
        $collager_id = Auth::user()->collager->id;
        // $data = QuizCollager::where('collager_id',$collager_id)->where('id',$quiz_collager_id)->with('quiz.quizType.quizCategory')->first();
        $data = QuizCollager::where('collager_id',$collager_id)->where('id',$quiz_collager_id)->first();
        $data->true_sum = $data->answerSave()->where('isTrue', 1)->count();
        $data->false_sum = $data->answerSave()->where('isTrue', 0)->count();
        $data->quiz = Quiz::find($data->quiz_id)->title;
        
        $answerSave = AnswerSave::where('quiz_collager_id',$data->id)->get();
        $collection = [];
        foreach ($answerSave as $i => $item) {
          $user_answer_content = "-";
          $user_answer_pic = "";
          // JAWABAN TIDAK KOSONG
          if ($item['collager_answer'] != '-') {
            // ISIAN
            if ($item->question->answer()->count() == 1) {
              // ISIAN BENAR
              if ($item->isTrue == 1) {
                $user_answer_content = $item->question->answer()->get()->where('option', $item->collager_answer)->first()->content;
              }
              // ISIAN SALAH
              else {
                $user_answer_content = $item['collager_answer'];
                $user_answer_pic = "";
              }
            }
            // OPTION
            else {
              $user_answer_content = $item->question->answer()->get()->where('option', $item->collager_answer)->first()->content;
              $user_answer_pic = $item->question->answer()->get()->where('option', $item->collager_answer)->first()->pic_url;
            }
          }
          $collection[$i] = [
            'quiz' => Quiz::find($data->quiz_id)->title,
            'question_id' => $item['question_id'],
            'question' => $item->question['question'],
            'pic_question' => $item->question['pic_url'],
            'review' => $item->question['review'],
            'trueAnswer' => $item->question->answer()->get()->where('isTrue', 1)->first()->option,
            'trueAnswerContent' => $item->question->answer()->get()->where('isTrue', 1)->first()->content,
            'trueAnswerPic' => $item->question->answer()->get()->where('isTrue', 1)->first()->pic_url,
            'user_true' => $item['isTrue'],
            'user_answer' => $item['collager_answer'],
            'user_answer_content' => $user_answer_content,
            'user_answer_pic' => $user_answer_pic,
          ];
        }

        $status_review = Quiz::find($data->quiz_id)->status_review;

        return response()->json([
            'status'           => 'success',
            'status_review'    => $status_review,
            'result'           => $data,
            'question'         => $collection,
        ]);

    }

}
